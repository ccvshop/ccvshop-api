<?php

namespace CCVShop\Api\Factory;

use CCVShop\Api\BaseResource;

class ResourceFactory
{
    public static function createFromApiResult($apiResult, BaseResource $resource): BaseResource
    {
        foreach ($apiResult as $property => $value) {
            if (!property_exists($resource, $property)) {
                continue;
            }

            if (!empty($resource->dates) && in_array($property, $resource->dates)) {
                $resource->{$property} = new \DateTime($value);
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
