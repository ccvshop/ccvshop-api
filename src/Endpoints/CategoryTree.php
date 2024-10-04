<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Category;
use CCVShop\Api\Resources\CategoryCollection;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class CategoryTree extends BaseEndpoint implements
    GetAll
{
    protected string $resourcePath = 'categorytree';

    /**
     * @return \CCVShop\Api\Resources\CategoryTree ()
     */
    protected function getResourceObject(): \CCVShop\Api\Resources\CategoryTree
    {
        return new \CCVShop\Api\Resources\CategoryTree($this->client);
    }

    protected function getResourceCollectionObject(): CategoryCollection
    {
        return new CategoryCollection();
    }

    /**
     * @param array $parameters
     * @return BaseResourceCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): BaseResourceCollection
    {
        /** @var Category $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
