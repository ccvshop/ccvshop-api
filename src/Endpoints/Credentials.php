<?php

declare(strict_types=1);

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

class Credentials extends BaseEndpoint implements Get, GetAll
{
    protected string $resourcePath = 'credentials';
    protected ?string $parentResourcePath = 'webshops';

    /**
     * @return Credential
     */
    protected function getResourceObject(): Credential
    {
        return new Credential($this->client);
    }

    /**
     * @return CredentialCollection
     */
    protected function getResourceCollectionObject(): CredentialCollection
    {
        return new CredentialCollection();
    }

    /**
     * @param int $id
     *
     * @return Credential
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): Credential
    {
        /** @var Credential $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return CredentialCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): CredentialCollection
    {
        /** @var CredentialCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param Webshop    $webshop
     * @param Credential $credential
     *
     * @return Credential
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function postFor(Webshop $webshop, Credential $credential): Credential
    {
        $this->setParent(ResourceFactory::createParentFromResource($webshop));

        /** @var Credential $result */
        $result = $this->restPost($credential);

        return $result;
    }

    /**
     * @param int        $webshopId
     * @param Credential $credential
     *
     * @return Credential
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function postForId(int $webshopId, Credential $credential): Credential
    {
        $this->setParent(ResourceFactory::createParent($this->client->webshops->getResourcePath(), $webshopId));

        /** @var Credential $result */
        $result = $this->restPost($credential);

        return $result;
    }
}
