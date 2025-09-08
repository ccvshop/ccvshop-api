<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductToCategoriesCollection;
use CCVShop\Api\Resources\ProductToCategory;

class ProductToCategories extends BaseEndpoint implements Get, Post, Delete
{
    protected string $resourcePath = 'producttocategories';
    // ProductToCategories have 2 resources where products OR categories can be used as a parent. For now, we support product as parent.
    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductToCategory
     */
    protected function getResourceObject(): ProductToCategory
    {
        return new ProductToCategory($this->client);
    }

    /**
     * @return ProductToCategoriesCollection
     */
    protected function getResourceCollectionObject(): ProductToCategoriesCollection
    {
        return new ProductToCategoriesCollection();
    }

    /**
     * @param ?int $id
     *
     * @return ProductToCategory
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(?int $id): ProductToCategory
    {
        if ($id === null) {
            throw new \InvalidArgumentException('producttocategories id is required');
        }

        /**
         * @var ProductToCategory $result
         */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @description Get all product categories by product resource.
     *
     * @param Product                        $product
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductToCategoriesCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductToCategoriesCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));

        /** @var ProductToCategoriesCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int                            $productId
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductToCategoriesCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getForProductId(int $productId, array $parameters = []): ProductToCategoriesCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $productId));

        /** @var ProductToCategoriesCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int                            $categoryId
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductToCategoriesCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getForCategoryId(int $categoryId, array $parameters = []): ProductToCategoriesCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->categories->getResourcePath(), $categoryId));

        /** @var ProductToCategoriesCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param ProductToCategory|null $productToCategory
     *
     * @return ProductToCategory
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?ProductToCategory $productToCategory = null): ProductToCategory
    {
        if (is_null($productToCategory)) {
            throw new \InvalidArgumentException(ProductToCategory::class . ' required');
        }

        /** @var ProductToCategory $result */
        $result = $this->restPost($productToCategory);

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
