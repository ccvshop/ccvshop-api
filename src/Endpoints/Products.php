<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Resources\AppConfig;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductCollection;

class Products extends BaseEndpoint implements
    Get,
    GetAll,
    Patch
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
        /** @var ProductCollection */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param Product|null $product
     * @return void
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function patch(?Product $product = null): void
    {
        if (is_null($product)) {
            throw new \InvalidArgumentException(Product::class . ' required');
        }

        /** @var AppConfig */
        $this->rest_patch($product->id, [
            'shortdescription'  => $product->shortdescription,
            'description'       => $product->description,
            'name'              => $product->name,
            'unit'              => $product->unit,
            'meta_description'  => $product->meta_description,
            'meta_keywords'     => $product->meta_keywords,
            'page_title'        => $product->page_title,
            'alias'             => $product->alias,
        ]);
    }
}
