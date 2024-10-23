<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\ProductProperty;
use CCVShop\Api\Resources\ProductPropertyGroup;
use CCVShop\Api\Resources\ProductPropertyCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductProperties extends BaseEndpoint implements
    Get,
    GetAll,
    Patch,
    Post
{

    public const TYPE_TEXT           = 'Text';
    public const TYPE_OPTION         = 'Option';
    public const TYPE_OPTIONCHECKBOX = 'OptionCheckbox';
    public const TYPE_CHECKBOX       = 'Checkbox';
    public const TYPE_GROUP          = 'Group';
    public const TYPE_COLLAPSEDGROUP = 'CollapsedGroup';
    public const TYPE_TEXTAREA       = 'TextArea';
    public const TYPE_PRICE          = 'Price';

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
     * @return ProductProperty
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductProperty
    {
        /** @var ProductProperty $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return ProductPropertyCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getAll(array $parameters = []): ProductPropertyCollection
    {
        /** @var ProductPropertyCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @description Get all product properties by a product property group resource.
     *
     * @param ProductPropertyGroup $productPropertyGroups
     * @param array $parameters
     * @return ProductPropertyCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getFor(ProductPropertyGroup $productPropertyGroups, array $parameters = []): ProductPropertyCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($productPropertyGroups));
        /** @var ProductPropertyCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @description Post a product property
     *
     * @param int|null $productPropertyGroupId
     * @param ProductProperty|null $productProperty
     * @return ProductProperty
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function post(int $productPropertyGroupId = null, ProductProperty $productProperty = null): ProductProperty
    {
        if ($productPropertyGroupId === null) {
            throw new InvalidArgumentException('product property group id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->productPropertyGroups->getResourcePath(), $productPropertyGroupId));

        if ($productProperty === null) {
            throw new InvalidArgumentException(ProductProperty::class . ' required');
        }

        $data = [
            'name'     => $productProperty->name,
            'type'     => $productProperty->type,
            'parent'   => $productProperty->parent,
            'position' => $productProperty->position,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($data);
    }

    /**
     * @description Patch a product property.
     *
     * @param ProductProperty|null $productProperty
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function patch(ProductProperty $productProperty = null): void
    {
        if ($productProperty === null) {
            throw new InvalidArgumentException(ProductProperty::class . ' required');
        }

        $data = [
            'name'     => $productProperty->name,
            'type'     => $productProperty->type,
            'parent'   => $productProperty->parent,
            'position' => $productProperty->position,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $this->rest_patch($productProperty->id, $data);
    }
}
