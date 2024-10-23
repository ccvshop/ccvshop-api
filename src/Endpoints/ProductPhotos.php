<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Put;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductPhoto;
use CCVShop\Api\Resources\ProductPhotosCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductPhotos extends BaseEndpoint implements
    Get,
    GetAll,
    Put
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
     * @return ProductPhoto
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductPhoto
    {
        /** @var ProductPhoto $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return ProductPhotosCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getAll(array $parameters = []): ProductPhotosCollection
    {
        /** @var ProductPhotosCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @description Get all product photos by product resource.
     * @param Product $product
     * @param array $parameters
     * @return ProductPhotosCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductPhotosCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));
        /** @var ProductPhotosCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function put(int $id, array $parameters = [])
    {
        if ($id === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $parent = ResourceFactory::createParent($this->client->products->getResourcePath(), $id);
        $this->setParent($parent);
        $this->rest_put($parameters);
    }
}
