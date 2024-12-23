<?php

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
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class Categories extends BaseEndpoint implements
    Get,
    GetAll,
    Patch,
    Post,
    Delete
{
    protected string $resourcePath = 'categories';

    /**
     * @return Category()
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
     * @return BaseResource
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): BaseResource
    {
        /** @var Category $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return CategoryCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getAll(array $parameters = []): CategoryCollection
    {
        /** @var CategoryCollection */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param Category|null $category
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function patch(?Category $category = null): void
    {
        if (is_null($category)) {
            throw new InvalidArgumentException(Category::class . ' required');
        }

        $data = [
            'name'               => $category->name,
            'description'        => $category->description,
            'description_bottom' => $category->description_bottom,
            'searchwords'        => $category->searchwords,
            'meta_description'   => $category->meta_description,
            'meta_keywords'      => $category->meta_keywords,
            'page_title'         => $category->page_title,
            'alias'              => $category->alias,
            'parentcategory_id'  => $category->parentcategory->id ?? null,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $this->rest_patch($category->id, $data);
    }

    /**
     * @param Category|null $category
     * @return Category
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function post(?Category $category = null): Category
    {
        if (is_null($category)) {
            throw new InvalidArgumentException(Category::class . ' required');
        }

        $data = [
            'name'               => $category->name,
            'description'        => $category->description,
            'description_bottom' => $category->description_bottom,
            'searchwords'        => $category->searchwords,
            'meta_description'   => $category->meta_description,
            'meta_keywords'      => $category->meta_keywords,
            'page_title'         => $category->page_title,
            'alias'              => $category->alias,
            'parentcategory_id'  => $category->parentcategory->id ?? null,
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
