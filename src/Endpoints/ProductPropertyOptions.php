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
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\ProductProperty;
use CCVShop\Api\Resources\ProductPropertyOption;
use CCVShop\Api\Resources\ProductPropertyOptionCollection;

class ProductPropertyOptions extends BaseEndpoint implements Get, GetAll, Patch, Post, Delete
{
    /**
     * @var string
     */
    protected string $resourcePath = 'productpropertyoptions';

    /**
     * @var string|null
     */
    protected ?string $parentResourcePath = 'productproperties';

    /**
     * @return ProductPropertyOption
     */
    protected function getResourceObject(): ProductPropertyOption
    {
        return new ProductPropertyOption($this->client);
    }

    /**
     * @return ProductPropertyOptionCollection
     */
    protected function getResourceCollectionObject(): ProductPropertyOptionCollection
    {
        return new ProductPropertyOptionCollection();
    }

    /**
     * @param int $id
     *
     * @return ProductPropertyOption
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): ProductPropertyOption
    {
        /** @var ProductPropertyOption $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductPropertyOptionCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(array $parameters = []): ProductPropertyOptionCollection
    {
        /** @var ProductPropertyOptionCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param ProductProperty                $productProperty
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductPropertyOptionCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFor(ProductProperty $productProperty, array $parameters = []): ProductPropertyOptionCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($productProperty));

        /** @var ProductPropertyOptionCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int|null                   $productPropertyId
     * @param ProductPropertyOption|null $productPropertyOption
     *
     * @return ProductPropertyOption
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(?int $productPropertyId = null, ?ProductPropertyOption $productPropertyOption = null): ProductPropertyOption
    {
        if ($productPropertyId === null) {
            throw new \InvalidArgumentException('product property group id is required');
        }
        if ($productPropertyOption === null) {
            throw new \InvalidArgumentException(ProductPropertyOption::class . ' required');
        }
        $this->setParent(ResourceFactory::createParent($this->client->productPropertyOptions->getParentResourcePath(), $productPropertyId));

        /** @var ProductPropertyOption $result */
        $result = $this->restPost($productPropertyOption);

        return $result;
    }

    /**
     * @param ProductPropertyOption|null $productPropertyOption
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch(?ProductPropertyOption $productPropertyOption = null): void
    {
        if ($productPropertyOption === null) {
            throw new \InvalidArgumentException(ProductPropertyOption::class . ' required');
        }

        $this->restPatch($productPropertyOption);
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
