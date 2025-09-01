<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\ProductPropertyCollection;
use CCVShop\Api\Resources\ProductPropertyValue;

class ProductPropertyValues extends BaseEndpoint implements Get, Patch, Delete, Post
{
    protected string $resourcePath = 'productpropertyvalues';

    /**
     * @return ProductPropertyValue
     */
    protected function getResourceObject(): ProductPropertyValue
    {
        return new ProductPropertyValue($this->client);
    }

    /**
     * @return ProductPropertyCollection
     */
    protected function getResourceCollectionObject(): ProductPropertyCollection
    {
        return new ProductPropertyCollection();
    }

    /**
     * @param int $id
     *
     * @return ProductPropertyValue
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): ProductPropertyValue
    {
        /** @var ProductPropertyValue $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param ProductPropertyValue|null $productPropertyValue
     *
     * @return ProductPropertyValue
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?ProductPropertyValue $productPropertyValue = null): ProductPropertyValue
    {
        if ($productPropertyValue === null) {
            throw new \InvalidArgumentException(ProductPropertyValue::class . ' required');
        }

        /** @var ProductPropertyValue $result */
        $result = $this->restPost($productPropertyValue);

        return $result;
    }

    /**
     * @param ProductPropertyValue|null $productPropertyValue
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\JsonException
     */
    public function patch(?ProductPropertyValue $productPropertyValue = null): void
    {
        if (is_null($productPropertyValue)) {
            throw new \InvalidArgumentException(ProductPropertyValue::class . ' required');
        }

        $this->restPatch($productPropertyValue);
    }

    /**
     * @param int $id
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\JsonException
     */
    public function delete(int $id): void
    {
        $this->restDelete($id);
    }
}
