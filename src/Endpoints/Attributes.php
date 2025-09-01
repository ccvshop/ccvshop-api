<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Attribute;
use CCVShop\Api\Resources\AttributeCollection;
use GuzzleHttp\Exception\GuzzleException;

class Attributes extends BaseEndpoint implements Get, GetAll
{
    /**
     * @var string
     */
    protected string $resourcePath = 'attributes';

    /**
     * @return Attribute
     */
    protected function getResourceObject(): Attribute
    {
        return new Attribute($this->client);
    }

    /**
     * @return AttributeCollection
     */
    protected function getResourceCollectionObject(): AttributeCollection
    {
        return new AttributeCollection();
    }

    /**
     * @param int $id
     *
     * @return Attribute
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): Attribute
    {
        /** @var Attribute $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return AttributeCollection
     *
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): AttributeCollection
    {
        /** @var AttributeCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param Attribute                      $attribute
     * @param array<string,int|float|string> $parameters
     *
     * @return AttributeCollection
     *
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(Attribute $attribute, array $parameters = []): AttributeCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($attribute));

        /** @var AttributeCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
