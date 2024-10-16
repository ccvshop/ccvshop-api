<?php

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
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductToPropertyGroups extends BaseEndpoint implements
    Get,
    Post,
    Delete
{
    protected string $resourcePath = 'producttopropertygroups';

    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductToPropertyGroup()
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
     * @return ProductToPropertyGroup
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductToPropertyGroup
    {
        /** @var ProductToPropertyGroup $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @description Get all product photos by product resource.
     * @param Product $product
     * @param array $parameters
     * @return ProductToPropertyGroupCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductToPropertyGroupCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));
        /** @var ProductToPropertyGroupCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param ProductToPropertyGroup|null $productToPropertyGroup
     * @return BaseResource
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function post(ProductToPropertyGroup $productToPropertyGroup = null)
    {
        if ($productToPropertyGroup === null) {
            throw new InvalidArgumentException(ProductToPropertyGroup::class . ' required');
        }

        $data = [
            'product_id' => $productToPropertyGroup->product_id,
            'product_property_group_id' => $productToPropertyGroup->product_property_group_id,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($data);
    }

    /**
     * @param int $id
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function delete(int $id): void
    {
        $this->rest_delete($id);
    }
}
