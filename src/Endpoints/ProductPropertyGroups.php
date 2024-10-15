<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\ProductPropertyGroup;
use CCVShop\Api\Resources\ProductPropertyGroupCollection;
use JsonException;

class ProductPropertyGroups extends BaseEndpoint implements
    Get,
    GetAll,
    Post,
    Delete,
    Patch
{
    protected string $resourcePath = 'ProductPropertyGroups';

    /**
     * @return ProductPropertyGroup()
     */
    protected function getResourceObject(): ProductPropertyGroup
    {
        return new ProductPropertyGroup($this->client);
    }

    /**
     * @return ProductPropertyGroupCollection
     */
    protected function getResourceCollectionObject(): ProductPropertyGroupCollection
    {
        return new ProductPropertyGroupCollection();
    }

    /**
     * @param int $id
     * @return ProductPropertyGroup
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|\ReflectionException
     */
    public function get(int $id): ProductPropertyGroup
    {
        /** @var ProductPropertyGroup $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return ProductPropertyGroupCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): ProductPropertyGroupCollection
    {
        /** @var ProductPropertyGroupCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }


    public function post(ProductPropertyGroup $productPropertyGroup = null)
    {
        if ($productPropertyGroup === null) {
            throw new \InvalidArgumentException(ProductPropertyGroup::class . ' required');
        }

        $data = [
            'name' => $productPropertyGroup->name,
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

    /**
     * @param ProductPropertyGroup|null $productPropertyGroup
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function patch(?ProductPropertyGroup $productPropertyGroup = null): void
    {
        if (is_null($productPropertyGroup)) {
            throw new \InvalidArgumentException(ProductPropertyGroup::class . ' required');
        }

        $data = [
            'name' => $productPropertyGroup->name,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $this->rest_patch($productPropertyGroup->id, $data);
    }
}
