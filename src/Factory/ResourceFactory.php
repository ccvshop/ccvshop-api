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

            if (!empty($resource->dates) && in_array($property, $resource->dates) && !empty($value)) {
                $resource->{$property} = new \DateTime($value);
            } elseif (!empty($resource->elementObjects) && array_key_exists($property, $resource->elementObjects) && !empty($value)) {
                $entity = static::objectToEntity($resource->elementObjects[$property], $value);
                dd($entity);
//              $resource->{$property} = $entity->items;
                $resource->{$property} = $entity;
            } else {
                $resource->{$property} = $value;
            }
        }

        return $resource;
    }

    private static function objectToEntity(string $entityClass, $value)
    {
        /**
         * Flow:
         * we hebben een array met data.
         * loop door de array,
         * is de value instanceof BaseEntity? roep deze functie opnieuw aan.
         * is de value instanceof collection? cast dan naar array
         * anders, value = value
         *
         * daarna komen wij binnen met een baseentity:
         * interactive_content {
         *      views [
         *          view {
         *              naam => test
         *              label => labeltje
         *              elements [
         *                  element {
         *                      type => button
         *                  },
         *                  element {
         *                      type => checkbox
         *                  },
         *              ]
         *          },
         *          view {
         *              naam => naampie
         *              label => babel!
         *              elements [
         *                  element {
         *                      type => text
         *                  },
         *                  element {
         *                      type => radio
         *                  },
         *              ]
         *          },
         *      ]
         * }
         *
         * hier moeten wij het volgende doen:
         * niet door array loopen, maar de collection properties ophalen van de baseentity. ($elementObjects)
         * daar loopen wij door heen, en zetten wij de property
         *
         */


        $entity = new $entityClass;
        if ($entity instanceof BaseEntityCollection) {
            foreach ($value as $element) {
                $elementClass = static::objectToEntity($entity::$entityClass, $element);
                $entity->append($elementClass);
            }
        } elseif ($entity instanceof BaseEntity) {
            foreach ($entity::$elementObjects as $property => $class) {
                $entity->{$property} = static::objectToEntity($class, $value->{$property});
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
