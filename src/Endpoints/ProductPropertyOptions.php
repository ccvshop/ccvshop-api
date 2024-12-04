<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\ProductProperty;
use CCVShop\Api\Resources\ProductPropertyOptionCollection;
use CCVShop\Api\Resources\ProductPropertyOption;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductPropertyOptions extends BaseEndpoint implements
    Get,
    GetAll,
    Patch,
    Post,
    Delete
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
     * @return ProductPropertyOption
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function get(int $id): ProductPropertyOption
    {
        /** @var ProductPropertyOption $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return ProductPropertyOptionCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(array $parameters = []): ProductPropertyOptionCollection
    {
        /** @var ProductPropertyOptionCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param ProductProperty $productProperty
     * @param array $parameters
     * @return ProductPropertyOptionCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFor(ProductProperty $productProperty, array $parameters = []): ProductPropertyOptionCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($productProperty));
        /** @var ProductPropertyOptionCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param int|null $productPropertyId
     * @param ProductPropertyOption|null $productPropertyOption
     * @return ProductPropertyOption
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(int $productPropertyId = null, ProductPropertyOption $productPropertyOption = null): ProductPropertyOption
    {
        if ($productPropertyId === null) {
            throw new InvalidArgumentException('product property group id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->productPropertyOptions->getParentResourcePath(), $productPropertyId));

        if ($productPropertyOption === null) {
            throw new InvalidArgumentException(ProductPropertyOption::class . ' required');
        }

        $data = [
            'name'     => $productPropertyOption->name,
            'position' => $productPropertyOption->position,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($data);
    }

    /**
     * @param ProductPropertyOption|null $productPropertyOption
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch(ProductPropertyOption $productPropertyOption = null): void
    {
        if ($productPropertyOption === null) {
            throw new InvalidArgumentException(ProductPropertyOption::class . ' required');
        }

        $data = [
            'name'     => $productPropertyOption->name,
            'position' => $productPropertyOption->position,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $this->rest_patch($productPropertyOption->id, $data);
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
