<?php

namespace CCVShop\Api\Resources\Entities;

abstract class BaseEntityCollection extends \ArrayObject
{
    public static $entityClass;

    public function __construct($array = [], $flags = \ArrayObject::ARRAY_AS_PROPS, $iteratorClass = "ArrayIterator")
    {
        parent::__construct($array, $flags, $iteratorClass);
    }

    public function addItem($item): void
    {
        if (!$item instanceof static::$entityClass) {
            throw new \InvalidArgumentException('$item (' .  get_class($item) . ') does not equal "' . static::$entityClass  . '"!');
        }

        $this->append($item);
    }
}
