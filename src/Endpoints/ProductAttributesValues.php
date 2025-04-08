<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductAttributeValue;
use CCVShop\Api\Resources\ProductAttributeCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

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
     * @return ProductAttributeValue
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function get(int $id): ProductAttributeValue
    {
        /** @var ProductAttributeValue $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param Product $product
     * @param array $parameters
     * @return ProductAttributeCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function getFor(Product $product, array $parameters = []): ProductAttributeCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));
        /** @var ProductAttributeCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

}
