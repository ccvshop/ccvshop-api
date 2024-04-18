<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductCollection;

class Products extends BaseEndpoint implements
    Get,
    GetAll
{
    protected string $resourcePath = 'products';

    /**
     * @return Product()
     */
    protected function getResourceObject(): Product
    {
        return new Product($this->client);
    }

    /**
     * @return ProductCollection
     */
    protected function getResourceCollectionObject(): ProductCollection
    {
        return new ProductCollection();
    }

    /**
     * @param int $id
     * @return Product
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): Product
    {
        /** @var Product $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return ProductCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getAll(array $parameters = []): ProductCollection
    {
        /** @var ProductCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
