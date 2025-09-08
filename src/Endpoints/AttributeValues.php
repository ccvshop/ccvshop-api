<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\Attribute;
use CCVShop\Api\Resources\AttributeValue;
use CCVShop\Api\Resources\AttributeValueCollection;
use GuzzleHttp\Exception\GuzzleException;

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
     *
     * @return AttributeValue
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): AttributeValue
    {
        /** @var AttributeValue $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param Attribute                      $attribute
     * @param array<string,int|float|string> $parameters
     *
     * @return AttributeValueCollection
     *
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(Attribute $attribute, array $parameters = []): AttributeValueCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($attribute));

        /** @var AttributeValueCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
