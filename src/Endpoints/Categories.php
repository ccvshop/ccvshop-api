<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Resources\Category;
use CCVShop\Api\Resources\CategoryCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;

class Categories extends BaseEndpoint implements
    Get,
    GetAll,
    Patch
{
    protected string $resourcePath = 'categories';

    /**
     * @return Category()
     */
    protected function getResourceObject(): Category
    {
        return new Category($this->client);
    }

    protected function getResourceCollectionObject(): CategoryCollection
    {
        return new CategoryCollection();
    }

    /**
     * @param int $id
     * @return BaseResource
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function get(int $id): BaseResource
    {
        /** @var Category $result */
        return $this->rest_getOne($id, []);
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

        $this->rest_patch($category->id, [
            'name'               => $category->name,
            'description'        => $category->description,
            'description_bottom' => $category->description_bottom,
            'searchwords'        => $category->searchwords,
            'meta_description'   => $category->meta_description,
            'meta_keywords'      => $category->meta_keywords,
            'page_title'         => $category->page_title,
            'alias'              => $category->alias,
        ]);
    }

    public function getAll(array $parameters = []): BaseResourceCollection
    {
        /** @var BaseResourceCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
