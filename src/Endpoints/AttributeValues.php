<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Attribute;
use CCVShop\Api\Resources\AttributeValue;
use CCVShop\Api\Resources\AttributeValueCollection;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use ReflectionException;

class AttributeValues extends BaseEndpoint implements Get
{
    /**
     * @var string
     */
    protected string $resourcePath = 'attributevalues';

    /**
     * @return AttributeValue
     */
    protected function getResourceObject(): AttributeValue
    {
        return new AttributeValue($this->client);
    }

    /**
     * @return AttributeValueCollection
     */
    protected function getResourceCollectionObject(): AttributeValueCollection
    {
        return new AttributeValueCollection();
    }

    /**
     * @param int $id
     * @return AttributeValue
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function get(int $id): AttributeValue
    {
        /** @var AttributeValue $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param Attribute $attribute
     * @param array $parameters
     * @return AttributeValueCollection
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getFor(Attribute $attribute, array $parameters = []): AttributeValueCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($attribute));
        /** @var AttributeValueCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

}
