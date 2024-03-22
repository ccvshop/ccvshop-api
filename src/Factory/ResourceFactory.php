<?php

namespace CCVShop\Api\Factory;

use CCVShop\Api\BaseResource;
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

            if ($property === 'interactive_content') {
//                dd($resource);
                if (!empty($resource->elementObjects)) {
                    if (array_key_exists($property, $resource->elementObjects)) {
//                        dd(123);
                    }
                }
            }

            if (!empty($resource->dates) && in_array($property, $resource->dates) && !empty($value)) {
                $resource->{$property} = new \DateTime($value);
            } elseif (!empty($resource->elementObjects) && array_key_exists($property, $resource->elementObjects) && !empty($value)) {
                //TODO:: dit moet, net zoals entityToArray in een functie en recursive, maar dan precies andersom.
                $entity = new $resource->elementObjects[$property];
                if ($entity instanceof BaseEntityCollection) {
                    $entity = new $resource->elementObjects[$property]::$entityClass;
                    dd($entity);
                } elseif ($entity instanceof BaseEntity) {
                    dd($entity);
//                    dd($resource->elementObjects);
                }
//                dd($resource->elementObjects[$property]);
                $resource->{$property} = $entity->items;
            } else {
                $resource->{$property} = $value;
            }
        }

        return $resource;
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
