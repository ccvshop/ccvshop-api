<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Resources\ProductPropertyValue;
use CCVShop\Api\Resources\ProductPropertyCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductPropertyValues extends BaseEndpoint implements
    Get,
    Patch,
    Delete,
    Post
{
    protected string $resourcePath = 'productpropertyvalues';

    /**
     * @return ProductPropertyValue
     */
    protected function getResourceObject(): ProductPropertyValue
    {
        return new ProductPropertyValue($this->client);
    }

    /**
     * @return ProductPropertyCollection
     */
    protected function getResourceCollectionObject(): ProductPropertyCollection
    {
        return new ProductPropertyCollection();
    }

    /**
     * @param int $id
     * @return ProductPropertyValue
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductPropertyValue
    {
        /** @var ProductPropertyValue $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param ProductPropertyValue|null $productPropertyValue
     * @return BaseResource
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function post(ProductPropertyValue $productPropertyValue = null)
    {
        if ($productPropertyValue === null) {
            throw new InvalidArgumentException(ProductPropertyValue::class . ' required');
        }

        $data = [
            'product_id' => $productPropertyValue->product_id,
            'product_property_id' => $productPropertyValue->product_property_id,
            'value' => $productPropertyValue->value,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($data);
    }

    /**
     * @param ProductPropertyValue|null $productPropertyValue
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|JsonException
     */
    public function patch(?ProductPropertyValue $productPropertyValue = null): void
    {
        if (is_null($productPropertyValue)) {
            throw new InvalidArgumentException(ProductPropertyValue::class . ' required');
        }

        $data = [
            'product_id' => $productPropertyValue->product_id,
            'product_property_id' => $productPropertyValue->product_property_id,
            'value' => $productPropertyValue->value,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $this->rest_patch($productPropertyValue->id, $data);
    }

    /**
     * @param int $id
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|JsonException
     */
    public function delete(int $id): void
    {
        $this->rest_delete($id);
    }
}
