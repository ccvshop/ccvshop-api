<?php

namespace CCVShop\Api\Factory;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Resources\Entities\AppCodeBlock\OptionCollection;
use CCVShop\Api\Resources\Entities\BaseEntity;
use CCVShop\Api\Resources\Entities\BaseEntityCollection;

class ResourceFactory
{
    public static function createFromApiResult($apiResult, BaseResource $resource): BaseResource
    {
        foreach ($apiResult as $property => $value) {
            if (!property_exists($resource, $property)) {
                continue;
            }

            if (!empty($resource->dates) && in_array($property, $resource->dates) && !empty($value)) {
                $resource->{$property} = new \DateTime($value);
            } elseif (!empty($resource->elementObjects) && array_key_exists($property, $resource->elementObjects) && !empty($value)) {
                $entity = static::objectToEntity($resource->elementObjects[$property], $value);
                $resource->{$property} = $entity;
            } else {
                $resource->{$property} = $value;
            }
        }

        return $resource;
    }

    private static function objectToEntity(string $entityClass, $value)
    {
        $entity = new $entityClass;

        if ($entity instanceof BaseEntityCollection) {
            foreach ($value as $element) {
                $elementClass = static::objectToEntity($entity::$entityClass, $element);
                $entity->addItem($elementClass);
            }
        } elseif ($entity instanceof BaseEntity) {
            foreach ($entity::$elementObjects as $property => $class) {
                // properties that are not required and not filled in won't be set on the response.
                if(isset($value->{$property})) {
                    $entity->{$property} = static::objectToEntity($class, $value->{$property});
                }
            }

            foreach (get_object_vars($value) as $property => $element) {
                if(empty($entity->{$property})) {
                    $entity->{$property} = $element;
                }
            }
        }

        return $entity;
    }

    public static function createParentFromResource(BaseResource $resource): \CCVShop\Api\ParentResource
    {
        return new \CCVShop\Api\ParentResource($resource->getEndpoint()->getResourcePath(), $resource->id);
    }

    public static function createParent(string $path, int $id): \CCVShop\Api\ParentResource
    {
        return new \CCVShop\Api\ParentResource($path, $id);
    }
}
