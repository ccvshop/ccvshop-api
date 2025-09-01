<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\CategoryCollection;

class CategoryTree extends BaseEndpoint implements GetAll
{
    protected string $resourcePath = 'categorytree';

    /**
     * @return \CCVShop\Api\Resources\CategoryTree
     */
    protected function getResourceObject(): \CCVShop\Api\Resources\CategoryTree
    {
        return new \CCVShop\Api\Resources\CategoryTree($this->client);
    }

    /**
     * @return CategoryCollection
     */
    protected function getResourceCollectionObject(): CategoryCollection
    {
        return new CategoryCollection();
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return CategoryCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): CategoryCollection
    {
        /** @var CategoryCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
