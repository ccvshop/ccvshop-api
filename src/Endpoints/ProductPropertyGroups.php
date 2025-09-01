<?php

declare(strict_types=1);

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

class ProductPropertyGroups extends BaseEndpoint implements Get, GetAll, Post, Delete, Patch
{
    protected string $resourcePath = 'productpropertygroups';

    /**
     * @return ProductPropertyGroup
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
     *
     * @return ProductPropertyGroup
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): ProductPropertyGroup
    {
        /** @var ProductPropertyGroup $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductPropertyGroupCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): ProductPropertyGroupCollection
    {
        /** @var ProductPropertyGroupCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param ProductPropertyGroup|null $productPropertyGroup
     *
     * @return ProductPropertyGroup
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?ProductPropertyGroup $productPropertyGroup = null): ProductPropertyGroup
    {
        if ($productPropertyGroup === null) {
            throw new \InvalidArgumentException(ProductPropertyGroup::class . ' required');
        }

        /** @var ProductPropertyGroup $result */
        $result = $this->restPost($productPropertyGroup);

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

    /**
     * @param ProductPropertyGroup|null $productPropertyGroup
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?ProductPropertyGroup $productPropertyGroup = null): void
    {
        if (is_null($productPropertyGroup)) {
            throw new \InvalidArgumentException(ProductPropertyGroup::class . ' required');
        }

        $this->restPatch($productPropertyGroup);
    }
}
