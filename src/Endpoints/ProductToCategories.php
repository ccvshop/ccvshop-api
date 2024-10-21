<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductToCategoriesCollection;
use CCVShop\Api\Resources\ProductToCategory;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductToCategories extends BaseEndpoint implements
    Get,
    Post
{
    protected string $resourcePath = 'producttocategories';
    // ProductToCategories have 2 resources where products OR categories can be used as a parent. For now, we support product as parent.
    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductToCategory()
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
     * @param int $id
     * @return ProductToCategory
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductToCategory
    {
        if ($id === null) {
            throw new InvalidArgumentException('producttocategories id is required');
        }

        /**
         * @var ProductToCategory $result
         */
        return $this->rest_getOne($id, []);
    }

    /**
     * @description Get all product categories by product resource.
     * @param Product $product
     * @param array $parameters
     * @return ProductToCategoriesCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductToCategoriesCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));
        /** @var ProductToCategoriesCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param ProductToCategory|null $productToCategory
     * @return BaseResource
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function post(?ProductToCategory $productToCategory = null)
    {
        if (is_null($productToCategory)) {
            throw new \InvalidArgumentException(ProductToCategory::class . ' required');
        }

        $data = [
            'category_id' => $productToCategory->category_id,
            'product_id' => $productToCategory->product_id,
        ];

        // Filter the array to remove entries with null values
        $filteredData = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($filteredData);
    }
}
