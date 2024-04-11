<?php

namespace CCVShop\Api\Factory;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Resources\Entities\AppCodeBlock\OptionCollection;
use CCVShop\Api\Resources\Entities\BaseEntity;
use CCVShop\Api\Resources\Entities\BaseEntityCollection;

class ResourceFactory
{
    /**
     * @param $apiResult
     * @param BaseResource $resource
     * @return BaseResource
     * @throws \Exception
     */
    public static function createFromApiResult($apiResult, BaseResource $resource): BaseResource
    {
        foreach ($apiResult as $property => $value) {
            if (!property_exists($resource, $property)) {
                continue;
            }

            if (!empty($resource->dates) && in_array($property, $resource->dates) && !empty($value)) {
                // return a correct date time object.
                $resource->{$property} = new \DateTime($value);
            } elseif (!empty($resource->entities) && array_key_exists($property, $resource->entities) && !empty($value)) {
                // An entity is an (sub element) of a resource, this could either be a collection or a single object.
                $entity = static::objectToEntity($resource->entities[$property], $value);
                $resource->{$property} = $entity;
            } else {
                $resource->{$property} = $value;
            }
        }

        return $resource;
    }

    /**
     * @param string $entityClass
     * @param mixed $value
     * @return BaseEntity|BaseEntityCollection|mixed
     */
    private static function objectToEntity(string $entityClass, $value)
    {
        $entity = new $entityClass;

        if ($entity instanceof BaseEntityCollection) {
            // Each entity collection property has it's own entity class.
            foreach ($value as $element) {
                $elementClass = static::objectToEntity($entity::$entityClass, $element);
                $entity->addItem($elementClass);
            }
        } elseif ($entity instanceof BaseEntity) {
            foreach ($entity::$entities as $property => $class) {
                // properties that are not required and not filled in won't be set on the response.
                if (isset($value->{$property})) {
                    $entity->{$property} = static::objectToEntity($class, $value->{$property});
                }
            }

            foreach (get_object_vars($value) as $property => $element) {
                if (empty($entity->{$property})) {
                    $entity->{$property} = $element;
                }
            }
        }

        return $entity;
    }

    /**
     * @param BaseResource $resource
     * @return \CCVShop\Api\ParentResource
     */
    public static function createParentFromResource(BaseResource $resource): \CCVShop\Api\ParentResource
    {
        return new \CCVShop\Api\ParentResource($resource->getEndpoint()->getResourcePath(), $resource->id);
    }

    /**
     * @param string $path
     * @param int $id
     * @return \CCVShop\Api\ParentResource
     */
    public static function createParent(string $path, int $id): \CCVShop\Api\ParentResource
    {
        return new \CCVShop\Api\ParentResource($path, $id);
    }
}
