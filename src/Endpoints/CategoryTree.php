<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\Category;
use CCVShop\Api\Resources\CategoryCollection;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class CategoryTree extends BaseEndpoint implements
    Get
{
    protected string $resourcePath = 'categorytree';

    /**
     * @return Category()
     */
    protected function getResourceObject(): Category
    {
        return new CategoryTre($this->client);
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
}
