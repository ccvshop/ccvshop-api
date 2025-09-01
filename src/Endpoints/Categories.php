<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Category;
use CCVShop\Api\Resources\CategoryCollection;

class Categories extends BaseEndpoint implements Get, GetAll, Patch, Post, Delete
{
    protected string $resourcePath = 'categories';

    /**
     * @return Category
     */
    protected function getResourceObject(): Category
    {
        return new Category($this->client);
    }

    /**
     * @return CategoryCollection
     */
    protected function getResourceCollectionObject(): CategoryCollection
    {
        return new CategoryCollection();
    }

    /**
     * @param int $id
     *
     * @return BaseResource
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): BaseResource
    {
        /** @var Category $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return CategoryCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): CategoryCollection
    {
        /** @var CategoryCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param Category|null $category
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?Category $category = null): void
    {
        if (is_null($category)) {
            throw new \InvalidArgumentException(Category::class . ' required');
        }

        $this->restPatch($category);
    }

    /**
     * @param Category|null $category
     *
     * @return Category
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?Category $category = null): Category
    {
        if (is_null($category)) {
            throw new \InvalidArgumentException(Category::class . ' required');
        }

        /** @var Category $result */
        $result = $this->restPost($category);

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
