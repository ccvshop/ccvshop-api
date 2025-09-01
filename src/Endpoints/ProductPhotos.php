<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\PutFor;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductPhoto;
use CCVShop\Api\Resources\ProductPhotosCollection;

class ProductPhotos extends BaseEndpoint implements Get, GetAll, PutFor, Delete
{
    protected string $resourcePath = 'productphotos';

    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductPhoto
     */
    protected function getResourceObject(): ProductPhoto
    {
        return new ProductPhoto($this->client);
    }

    /**
     * @return ProductPhotosCollection
     */
    protected function getResourceCollectionObject(): ProductPhotosCollection
    {
        return new ProductPhotosCollection();
    }

    /**
     * @param int $id
     *
     * @return ProductPhoto
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): ProductPhoto
    {
        /** @var ProductPhoto $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductPhotosCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): ProductPhotosCollection
    {
        /** @var ProductPhotosCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @description Get all product photos by product resource.
     *
     * @param Product                        $product
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductPhotosCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductPhotosCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));

        /** @var ProductPhotosCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @return void
     *
     * @deprecated see \CCVShop\Api\Endpoints\ProductPhotos::putFor
     */
    public function put(): void
    {
        trigger_error('Use ProductPhotos::putFor()', E_USER_ERROR);
    }

    /**
     * @param Product|null                 $product
     * @param ProductPhotosCollection|null $productPhotosCollection
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function putFor(?Product $product = null, ?ProductPhotosCollection $productPhotosCollection = null): void
    {
        if ($product === null) {
            throw new \InvalidArgumentException('Missing required parameter: Product');
        }
        if ($productPhotosCollection === null) {
            throw new \InvalidArgumentException('Missing required parameter: ProductPhotosCollection');
        }

        $parent = ResourceFactory::createParent($this->client->products->getResourcePath(), $product->getId());
        $this->setParent($parent);
        $this->restPut($productPhotosCollection);
    }

    /**
     * @param int|null          $productId
     * @param ProductPhoto|null $productPhoto
     *
     * @return ProductPhoto
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(?int $productId = null, ?ProductPhoto $productPhoto = null): ProductPhoto
    {
        if ($productId === null) {
            throw new \InvalidArgumentException('product id is required');
        }
        if ($productPhoto === null) {
            throw new \InvalidArgumentException(ProductPhoto::class . ' required');
        }
        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $productId));

        /** @var ProductPhoto $result */
        $result = $this->restPost($productPhoto);

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
