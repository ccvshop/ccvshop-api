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
use CCVShop\Api\Resources\ProductPropertyCollection;
use CCVShop\Api\Resources\ProductPropertyGroup;

class ProductProperties extends BaseEndpoint implements Get, GetAll, Patch, Post, Delete
{
    public const TYPE_TEXT = 'Text';
    public const TYPE_OPTION = 'Option';
    public const TYPE_OPTIONCHECKBOX = 'OptionCheckbox';
    public const TYPE_CHECKBOX = 'Checkbox';
    public const TYPE_GROUP = 'Group';
    public const TYPE_COLLAPSEDGROUP = 'CollapsedGroup';
    public const TYPE_TEXTAREA = 'TextArea';
    public const TYPE_PRICE = 'Price';

    protected string $resourcePath = 'productproperties';

    protected ?string $parentResourcePath = 'productpropertygroups';

    /**
     * @return ProductProperty
     */
    protected function getResourceObject(): ProductProperty
    {
        return new ProductProperty($this->client);
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
     * @return ProductProperty
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): ProductProperty
    {
        /** @var ProductProperty $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductPropertyCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): ProductPropertyCollection
    {
        /** @var ProductPropertyCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @description Get all product properties by a product property group resource.
     *
     * @param ProductPropertyGroup           $productPropertyGroups
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductPropertyCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(ProductPropertyGroup $productPropertyGroups, array $parameters = []): ProductPropertyCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($productPropertyGroups));

        /** @var ProductPropertyCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @description Post a product property
     *
     * @param int|null             $productPropertyGroupId
     * @param ProductProperty|null $productProperty
     *
     * @return ProductProperty
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?int $productPropertyGroupId = null, ?ProductProperty $productProperty = null): ProductProperty
    {
        if ($productPropertyGroupId === null) {
            throw new \InvalidArgumentException('product property group id is required');
        }
        if ($productProperty === null) {
            throw new \InvalidArgumentException(ProductProperty::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->productPropertyGroups->getResourcePath(), $productPropertyGroupId));

        /** @var ProductProperty $result */
        $result = $this->restPost($productProperty);

        return $result;
    }

    /**
     * @description Patch a product property.
     *
     * @param ProductProperty|null $productProperty
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?ProductProperty $productProperty = null): void
    {
        if ($productProperty === null) {
            throw new \InvalidArgumentException(ProductProperty::class . ' required');
        }

        $this->restPatch($productProperty);
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
