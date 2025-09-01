<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductToPropertyGroup;
use CCVShop\Api\Resources\ProductToPropertyGroupCollection;

class ProductToPropertyGroups extends BaseEndpoint implements Get, Post, Delete
{
    protected string $resourcePath = 'producttopropertygroups';

    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductToPropertyGroup
     */
    protected function getResourceObject(): ProductToPropertyGroup
    {
        return new ProductToPropertyGroup($this->client);
    }

    /**
     * @return ProductToPropertyGroupCollection
     */
    protected function getResourceCollectionObject(): ProductToPropertyGroupCollection
    {
        return new ProductToPropertyGroupCollection();
    }

    /**
     * @param int $id
     *
     * @return ProductToPropertyGroup
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): ProductToPropertyGroup
    {
        /** @var ProductToPropertyGroup $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @description Get all product photos by product resource.
     *
     * @param Product                        $product
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductToPropertyGroupCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductToPropertyGroupCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));

        /** @var ProductToPropertyGroupCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param ProductToPropertyGroup|null $productToPropertyGroup
     *
     * @return BaseResource
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?ProductToPropertyGroup $productToPropertyGroup = null): BaseResource
    {
        if ($productToPropertyGroup === null) {
            throw new \InvalidArgumentException(ProductToPropertyGroup::class . ' required');
        }
        /** @var ProductToPropertyGroup $result */
        $result = $this->restPost($productToPropertyGroup);

        return $result;
    }

    /**
     * @param int $id
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function delete(int $id): void
    {
        $this->restDelete($id);
    }
}
