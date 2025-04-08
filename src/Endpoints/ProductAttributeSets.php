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
use CCVShop\Api\Resources\ProductAttributeCollection;
use CCVShop\Api\Resources\ProductAttributeSet;
use CCVShop\Api\Resources\ProductAttributeSetCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductAttributeSets extends BaseEndpoint
{
    /**
     * @var string
     */
    protected string $resourcePath = 'productattributesets';

    /**
     * @return ProductAttributeSet
     */
    protected function getResourceObject(): ProductAttributeSet
    {
        return new ProductAttributeSet($this->client);
    }

    /**
     * @return ProductAttributeSetCollection
     */
    protected function getResourceCollectionObject(): ProductAttributeSetCollection
    {
        return new ProductAttributeSetCollection();
    }

    /**
     * @param Product $product
     * @param array $parameters
     * @return ProductAttributeSetCollection
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductAttributeSetCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));
        /** @var ProductAttributeSetCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
