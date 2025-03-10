<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Credential;
use CCVShop\Api\Resources\CredentialCollection;
use CCVShop\Api\Resources\Webshop;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use ReflectionException;

class Credentials extends BaseEndpoint implements
    Get,
    GetAll
{
    protected string  $resourcePath       = 'credentials';
    protected ?string $parentResourcePath = 'webshops';

    /**
     * @return Credential
     */
    protected function getResourceObject(): Credential
    {
        return new Credential($this->client);
    }

    /**
     * @return CredentialCollection<Credential>
     */
    protected function getResourceCollectionObject(): CredentialCollection
    {
        return new CredentialCollection();
    }

    /**
     * @param int $id
     *
     * @return Credential
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function get(int $id): Credential
    {
        /** @var Credential $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     *
     * @return CredentialCollection<Credential>
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getAll(array $parameters = []): CredentialCollection
    {
        /** @var CredentialCollection<Credential> $collection */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param Webshop $webshop
     * @param array $data
     *
     * @return Credential
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function postFor(Webshop $webshop, array $data): Credential
    {
        $this->setParent(ResourceFactory::createParentFromResource($webshop));

        /** @var Credential $result */
        return $this->rest_post($data);
    }

    /**
     * @param int $webshopId
     * @param array $data
     *
     * @return Credential
     * @throws InvalidHashOnResult
     * @throws JsonException
     * @throws InvalidResponseException
     * @throws ReflectionException
     */
    public function postForId(int $webshopId, array $data): Credential
    {
        $this->setParent(ResourceFactory::createParent($this->client->webshops->getResourcePath(), $webshopId));

        /** @var Credential $result */
        return $this->rest_post($data);
    }
}
