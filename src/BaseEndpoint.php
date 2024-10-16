<?php
declare(strict_types=1);

namespace CCVShop\Api;

use Carbon\Carbon;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ExceptionFactory;
use CCVShop\Api\Resources\Entities\BaseEntity;
use CCVShop\Api\Resources\Entities\BaseEntityCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;

abstract class BaseEndpoint
{
    protected ApiClient $client;
    private ?ParentResource $parent = null;
    protected ?int $parentId = null;
    protected ?string $parentResourcePath = null;
    protected string $resourcePath;
    protected string $acceptHeader = self::ACCEPT_HEADER_WEBSHOP;
    private ?string $currentMethod = null;
    private ?string $currentDate = null;
    private const DELETE = 'DELETE';
    private const GET = 'GET';
    private const POST = 'POST';
    private const PUT = 'PUT';
    private const PATCH = 'PATCH';
    private const API_PREFIX = '/api/rest/v1/';
    public const ACCEPT_HEADER_WEBSHOP = 'application/vnd.verto.webshop+json';
    public const ACCEPT_HEADER_SALESPOS = 'application/vnd.verto.salespos+json';

    private const ACCEPT_HEADERS = [
        self::ACCEPT_HEADER_WEBSHOP,
        self::ACCEPT_HEADER_SALESPOS
    ];

    protected ?string $acceptLanguage = null;

    abstract protected function getResourceObject(): BaseResource;

    abstract protected function getResourceCollectionObject(): BaseResourceCollection;

    /**
     * @param ApiClient $api
     */
    public function __construct(ApiClient $api)
    {
        $this->client = $api;
    }

    /**
     * @param int $id
     * @param array $filters
     *
     * @return BaseResource
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    protected function rest_getOne(int $id, array $filters): BaseResource
    {
        $this->setCurrentMethod(self::GET)
            ->setCurrentDate();

        $uri = $this->getUri() . '/' . $id . $this->filtersToQuery($filters);

        $headers = [
            'headers' => [
                'x-public'        => $this->client->apiCredentials->getPublic(),
                'x-hash'          => $this->getHash($uri),
                'x-date'          => $this->getCurrentDate(),
                'accept'          => $this->getAcceptHeader(),
                'accept-language' => $this->getAcceptLanguage()
            ],
        ];

        $result = $this->doCall($uri, $headers);

        return Factory\ResourceFactory::createFromApiResult($result, $this->getResourceObject());
    }

    /**
     * @param null $from
     * @param null $limit
     * @param array $filters
     *
     * @return BaseResourceCollection
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    protected function rest_getAll($from = null, $limit = null, array $filters = []): BaseResourceCollection
    {
        $this->setCurrentMethod(self::GET)->setCurrentDate();

        $uri = $this->getUri() . $this->filtersToQuery($filters);

        $headers = [
            'headers' => [
                'x-public'        => $this->client->apiCredentials->getPublic(),
                'x-hash'          => $this->getHash($uri),
                'x-date'          => $this->getCurrentDate(),
                'accept'          => $this->getAcceptHeader(),
                'accept-language' => $this->getAcceptLanguage()
            ],

        ];

        $result = $this->doCall($uri, $headers);
        $collection = $this->getResourceCollectionObject();

        if ($result === null) {
            return $collection;
        }

        if (!isset($result->items)) {
            $collection[] = Factory\ResourceFactory::createFromApiResult($result, $this->getResourceObject());
        } else {
            $collection->next = $result->next ?? null;
            $collection->previous = $result->previous ?? null;
            foreach ($result->items as $item) {
                $collection[] = Factory\ResourceFactory::createFromApiResult($item, $this->getResourceObject());
            }
        }

        return $collection;
    }

    /**
     * @param array $data
     *
     * @return BaseResource
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    protected function rest_post(array $data): BaseResource
    {
        $this->setCurrentMethod(self::POST)->setCurrentDate();

        $uri = $this->getUri();
        $data = $this->checkForEntities($data);

        $headers = [
            'headers' => [
                'x-public' => $this->client->apiCredentials->getPublic(),
                'x-hash'   => $this->getHash($uri, $data),
                'x-date'   => $this->getCurrentDate(),
                'accept'   => $this->getAcceptHeader()
            ],
            'json'    => $data,

        ];
        $result = $this->doCall($uri, $headers);

        return Factory\ResourceFactory::createFromApiResult($result, $this->getResourceObject());
    }

    /**
     * @param mixed $data
     * @return array|mixed|\stdClass
     */
    private function checkForEntities($data)
    {
        // If it is an array, check for defined sub entities and parse them.
        if (is_array($data)) {
            foreach ($data as $property => $value) {
                if ($value instanceof BaseEntity) {
                    $data[$property] = $this->checkForEntities($value);
                } elseif ($value instanceof BaseEntityCollection) {
                    $data[$property] = $value->getArrayCopy();
                } else {
                    $data[$property] = $value;
                }
            }
        } elseif ($data instanceof BaseEntity) {
            $data = $this->entityToObject($data);
        } elseif ($data instanceof BaseEntityCollection) {
            $data = $data->getArrayCopy();
        }

        // It is an object not an entity, and not an array that holds any (more) sub entities.
        // e.g. it could be a Resource\webhook.
        return $data;
    }

    /**
     * @param BaseEntity $data
     * @return \stdClass
     */
    private function entityToObject(BaseEntity $data): \stdClass
    {
        $entity = new \stdClass();

        // Loop through the collection properties to turn them into an array.
        foreach ($data::$entities as $property => $class) {
            if (!is_null($data->{$property})) {
                $entity->{$property} = $this->checkForEntities($data->{$property}->getArrayCopy());
            }
        }

        // Set all the other variables that are not set yet through $$entities
        foreach (get_object_vars($data) as $property => $value) {
            if (!isset($entity->{$property}) && !empty($value)) {
                $entity->{$property} = $data->{$property};
            }
        }

        return $entity;
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return void
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    protected function rest_patch(int $id, array $data): void
    {
        $this->setCurrentMethod(self::PATCH)->setCurrentDate();

        $uri = $this->getUri() . '/' . $id;

        $headers = [
            'headers' => [
                'x-public'        => $this->client->apiCredentials->getPublic(),
                'x-hash'          => $this->getHash($uri, $data),
                'x-date'          => $this->getCurrentDate(),
                'accept'          => $this->getAcceptHeader(),
                'accept-language' => $this->getAcceptLanguage()
            ],
            'json'    => $data,

        ];
        $this->doCall($uri, $headers);
    }

    /**
     * @param array $data
     *
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    protected function rest_put(array $data): void
    {
        $this->setCurrentMethod(self::PUT)->setCurrentDate();
        $uri = $this->getUri();
        $headers = [
            'headers' => [
                'x-public' => $this->client->apiCredentials->getPublic(),
                'x-hash'   => $this->getHash($uri, $data),
                'x-date'   => $this->getCurrentDate(),
                'accept'   => $this->getAcceptHeader(),
            ],
            'json'    => $data,

        ];
        $this->doCall($uri, $headers);
    }

    /**
     * @param int $id
     *
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    protected function rest_delete(int $id): void
    {
        $this->setCurrentMethod(self::DELETE)->setCurrentDate();

        $uri = $this->getUri() . '/' . $id;

        $headers = [
            'headers' => [
                'x-public' => $this->client->apiCredentials->getPublic(),
                'x-hash'   => $this->getHash($uri),
                'x-date'   => $this->getCurrentDate(),
                'accept'   => $this->getAcceptHeader(),
            ]
        ];
        $this->doCall($uri, $headers);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        if ($this->parent !== null) {
            $uri = sprintf('%s%s/%s/%s', self::API_PREFIX, $this->parent->path, $this->parent->id, $this->resourcePath);
            $this->setParent(null);

            return $uri;
        }

        return sprintf('%s%s', self::API_PREFIX, $this->resourcePath);
    }

    /**
     * @param Response $res
     * @param string $uri
     *
     * @return void
     * @throws Exceptions\InvalidHashOnResult
     */
    protected function validateResponse(Response $res, string $uri): void
    {
        $dataToHash = [
            $this->client->apiCredentials->getPublic(),
            $this->getCurrentMethod(),
            $uri,
            $res->getBody(),
            $res->getHeader('x-date')[0],

        ];

        $xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->client->apiCredentials->getSecret());

        if ($xHash !== $res->getHeader('x-hash')[0]) {
            throw new InvalidHashOnResult('Result hash not equal');
        }
    }

    /**
     * @param array $filters
     *
     * @return string
     */
    protected function filtersToQuery(array $filters = []): string
    {
        if (empty($filters)) {
            return '';
        }

        return '?' . http_build_query($filters);
    }

    /**
     * @param string $uri
     * @param array $data
     *
     * @return null|\stdClass
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     */
    private function doCall(string $uri, array $data): ?\stdClass
    {
        $client = new Client([
            'base_uri' => $this->client->apiCredentials->getHostName(),
        ]);

        try {
            $res = $client->request($this->getCurrentMethod(), $uri, $data);

            $this->validateResponse($res, $uri);

            if (empty((string)$res->getBody())) {
                return null;
            }

            try {
                return json_decode((string)$res->getBody(), false, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                throw new InvalidResponseException($e->getMessage(). "\n\n" . $e->getTraceAsString());
            }
        } catch (ServerException|ClientException $e) {
            throw ExceptionFactory::createFromApiResult((string)$e->getResponse()->getBody(),  $e->getTraceAsString(), $uri, $this->getCurrentMethod());
        }
    }

    /**
     * @param string $uri
     * @param array|null $data
     *
     * @return string
     * @throws \JsonException
     */
    private function getHash(string $uri, ?array $data = null): string
    {
        $dataToHash = [
            $this->client->apiCredentials->getPublic(),
            $this->getCurrentMethod(),
            $uri,
            $data !== null ? json_encode($data, JSON_THROW_ON_ERROR) : '',
            $this->getCurrentDate(),

        ];

        return hash_hmac('sha512', implode('|', $dataToHash), $this->client->apiCredentials->getSecret());
    }

    /**
     * @return string|null
     */
    private function getCurrentMethod(): ?string
    {
        return $this->currentMethod;
    }

    /**
     * @param string|null $currentMethod
     *
     * @return $this
     */
    private function setCurrentMethod(?string $currentMethod): self
    {
        $this->currentMethod = $currentMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentDate(): string
    {
        return $this->currentDate;
    }

    /**
     * @return $this
     */
    public function setCurrentDate(): self
    {
        $this->currentDate = Carbon::Now('utc')->format('c');

        return $this;
    }

    /**
     * @return string
     */
    public function getResourcePath(): string
    {
        return $this->resourcePath;
    }

    /**
     * @return string
     */
    public function getParentResourcePath(): string
    {
        return $this->parentResourcePath;
    }

    /**
     * @param ParentResource|null $parent
     *
     * @return void
     */
    protected function setParent(?ParentResource $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getAcceptHeader(): string
    {
        return $this->acceptHeader;
    }

    public function getAcceptLanguage(): ?string
    {
        return $this->acceptLanguage;
    }

    public function setAcceptLanguage(string $language): void
    {
        if (strlen($language) !== 2) {
            throw new \InvalidArgumentException('Accept language should be an 2 code');
        }

        $this->acceptLanguage = $language;
    }

    /**
     * @description when setting a different accept header.
     * You'll be able to determine which schema you'll want to use in your requests.
     * e.g. use: $apiClient->endpoint->setAcceptHeader($apiClient->endpoint::ACCEPT_HEADER_SALESPOS) in order to use CCV SalesPos specific API schema's in any following calls.
     * @param string $acceptHeader
     * @return void
     */
    public function setAcceptHeader(string $acceptHeader): void
    {
        if (!in_array($acceptHeader, self::ACCEPT_HEADERS, true)) {
            throw new \InvalidArgumentException('Accept header should be one of the following types: ' . implode(', ', self::ACCEPT_HEADERS));
        }

        $this->acceptHeader = $acceptHeader;
    }
}
