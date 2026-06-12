<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductRelevantCollection;

class ProductRelevant extends BaseEndpoint implements Get, Post, Delete
{
    protected string $resourcePath = 'productrelevant';
    protected ?string $parentResourcePath = 'products';

    /**
     * @return \CCVShop\Api\Resources\ProductRelevant
     */
    public function getResourceObject(): \CCVShop\Api\Resources\ProductRelevant
    {
        return new \CCVShop\Api\Resources\ProductRelevant($this->client);
    }

    /**
     * @return ProductRelevantCollection
     */
    public function getResourceCollectionObject(): ProductRelevantCollection
    {
        return new ProductRelevantCollection();
    }

    /**
     * @param int $id
     *
     * @return \CCVShop\Api\Resources\ProductRelevant
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): \CCVShop\Api\Resources\ProductRelevant
    {
        /**
         * @var \CCVShop\Api\Resources\ProductRelevant $result
         */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param Product                        $product
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductRelevantCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFor(Product $product, array $parameters = []): ProductRelevantCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));

        /** @var ProductRelevantCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int|null                                    $productId
     * @param \CCVShop\Api\Resources\ProductRelevant|null $productRelevant
     *
     * @return \CCVShop\Api\Resources\ProductRelevant
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(?int $productId = null, ?\CCVShop\Api\Resources\ProductRelevant $productRelevant = null): \CCVShop\Api\Resources\ProductRelevant
    {
        if ($productId === null) {
            throw new \InvalidArgumentException('product id is required');
        }
        if ($productRelevant === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\ProductRelevant::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $productId));

        /** @var \CCVShop\Api\Resources\ProductRelevant $result */
        $result = $this->restPost($productRelevant);

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
