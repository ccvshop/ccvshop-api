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
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductCollection;
use GuzzleHttp\Exception\GuzzleException;

class Products extends BaseEndpoint implements Get, GetAll, Patch, Post, Delete
{
    protected string $resourcePath = 'products';

    /**
     * @return Product
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
     *
     * @return Product
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): Product
    {
        /** @var Product $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param int                            $id
     * @param array<string,int|float|string> $parameters
     *
     * @return Product
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getWithParameters(int $id, array $parameters): Product
    {
        /** @var Product $result */
        $result = $this->restGetOne($id, $parameters);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): ProductCollection
    {
        /** @var ProductCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param Product|null $product
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function patch(?Product $product = null): void
    {
        if (is_null($product)) {
            throw new \InvalidArgumentException(Product::class . ' required');
        }

        $this->restPatch($product);
    }

    /**
     * @param Product|null $product
     *
     * @return Product
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?Product $product = null): Product
    {
        if (is_null($product)) {
            throw new \InvalidArgumentException(Product::class . ' required');
        }

        /** @var Product $result */
        $result = $this->restPost($product);

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
