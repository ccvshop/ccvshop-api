<?php

namespace CCVShop\Api\Factory;

use CCVShop\Api\BaseResource;
use CCVShop\Api\ParentResource;
use CCVShop\Api\Resources\Entities\BaseEntity;
use CCVShop\Api\Resources\Entities\BaseEntityCollection;
use CCVShop\Api\Resources\Entities\Entity;
use DateTime;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use stdClass;

class ResourceFactory
{
    /**
     * @param stdClass $apiResult
     * @param BaseResource $resource
     * @return BaseResource
     * @throws ReflectionException
     */
    public static function createFromApiResult(stdClass $apiResult, BaseResource $resource): BaseResource
    {
        foreach ($apiResult as $property => $value) {
            if (!property_exists($resource, $property)) {
                continue;
            }

            if (!empty($resource->dates) && in_array($property, $resource->dates) && !empty($value)) {
                // return a correct date time object.
                $resource->{$property} = new DateTime($value);
            } elseif (!empty($resource->entities) && array_key_exists($property, $resource->entities) && !empty($value)) {
                // An entity is a (sub element) of a resource, this could either be a collection or a single object.
                $entity = static::objectToEntityClass($value, $resource->entities[$property]);
                $resource->{$property} = $entity;
            } else {
                $resource->{$property} = $value;
            }
        }

        return $resource;
    }

    /**
     * @param mixed $value
     * @param string $entityClass
     * @return BaseEntity|BaseEntityCollection|mixed
     * @throws ReflectionException
     */
    private static function objectToEntityClass($value, string $entityClass)
    {
        $reference = new ReflectionClass($entityClass);

        // Validate that the reflection is an actual entity of some sort.
        if (!$reference->implementsInterface(Entity::class)) {
            throw new InvalidArgumentException('Object should implement entity interface.');
        }

        $entity = new $entityClass;

        if ($entity instanceof BaseEntityCollection && is_array($value)) {
            // Each entity collection property has it's own entity class.
            foreach ($value as $element) {
                $elementClass = static::objectToEntityClass($element, $entity::$entityClass);
                $entity->addItem($elementClass);
            }
        } elseif ($entity instanceof BaseEntity && is_object($value)) {
            $entity = static::assignValueToEntity($entity, $value);
        }

        return $entity;
    }

    /**
     * @param BaseEntity $entity
     * @param stdClass $value
     * @return BaseEntity
     * @throws ReflectionException
     */
    private static function assignValueToEntity(BaseEntity $entity, stdClass $value): BaseEntity
    {
        foreach ($entity::$entities as $property => $class) {
            // properties that are not required and not filled in won't be set on the response.
            if (isset($value->{$property})) {
                $entity->{$property} = static::objectToEntityClass($value->{$property}, $class);
            }
        }

        foreach (get_object_vars($value) as $property => $element) {
            if (empty($entity->{$property})) {
                $entity->{$property} = $element;
            }
        }

        return $entity;
    }

    /**
     * @param BaseResource $resource
     * @return ParentResource
     */
    public static function createParentFromResource(BaseResource $resource): ParentResource
    {
        return new ParentResource($resource->getEndpoint()->getResourcePath(), $resource->id);
    }

    /**
     * @param string $path
     * @param int $id
     * @return ParentResource
     */
    public static function createParent(string $path, int $id): ParentResource
    {
        return new ParentResource($path, $id);
    }
}
