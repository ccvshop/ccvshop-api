<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductRelevant;
use CCVShop\Api\Resources\ProductRelevantCollection;
use CCVShop\Api\Resources\ProductToPropertyGroupCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;


class ProductsRelevant extends BaseEndpoint implements
    Get,
    Post,
    delete
{
    protected string  $resourcePath       = 'productrelevant';
    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductRelevant()
     */
    protected function getResourceObject(): ProductRelevant
    {
        return new ProductRelevant($this->client);
    }

    /**
     * @return ProductRelevantCollection()
     */
    protected function getResourceCollectionObject(): ProductRelevantCollection
    {
        return new ProductRelevantCollection();
    }

    /**
     * @param int $id
     * @return ProductRelevant
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductRelevant
    {
        if ($id === null) {
            throw new InvalidArgumentException('id is required');
        }

        /**
         * @var ProductRelevant $result
         */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param Product $product
     * @param array $parameters
     * @return ProductRelevantCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFor(Product $product, array $parameters = []): ProductRelevantCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));
        /** @var ProductRelevantCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param int|null $productId
     * @param ProductRelevant|null $productRelevant
     * @return ProductRelevant
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(int $productId = null, ProductRelevant $productRelevant = null): ProductRelevant
    {
        if ($productId === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $productId));

        if ($productRelevant === null) {
            throw new InvalidArgumentException(ProductRelevant::class . ' required');
        }

        $data = [
            'child_product_id' => $productRelevant->child_product_id
        ];

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
