<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductAttributeCollection;
use CCVShop\Api\Resources\ProductAttributeValue;
use GuzzleHttp\Exception\GuzzleException;

class ProductAttributesValues extends BaseEndpoint implements Get
{
    /**
     * @var string
     */
    protected string $resourcePath = 'productattributevalues';

    /**
     * @return ProductAttributeValue
     */
    protected function getResourceObject(): ProductAttributeValue
    {
        return new ProductAttributeValue($this->client);
    }

    /**
     * @return ProductAttributeCollection
     */
    protected function getResourceCollectionObject(): ProductAttributeCollection
    {
        return new ProductAttributeCollection();
    }

    /**
     * @param int $id
     *
     * @return ProductAttributeValue
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): ProductAttributeValue
    {
        /** @var ProductAttributeValue $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param Product                        $product
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductAttributeCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws GuzzleException
     */
    public function getFor(Product $product, array $parameters = []): ProductAttributeCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));

        /** @var ProductAttributeCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
