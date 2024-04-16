<?php

namespace CCVShop\Api\Resources\Entities;

abstract class BaseEntityCollection extends \ArrayObject implements Entity
{

    public static $entityClass;

    /**
     * @param array $array
     * @param int $flags
     * @param string $iteratorClass
     */
    public function __construct(array $array = [], int $flags = \ArrayObject::ARRAY_AS_PROPS, string $iteratorClass = 'ArrayIterator')
    {
        parent::__construct($array, $flags, $iteratorClass);
    }

    /**
     * @param mixed $item
     * @return void
     */
    public function addItem($item): void
    {
        if (!$item instanceof static::$entityClass) {
            throw new \InvalidArgumentException('$item (' .  get_class($item) . ') does not equal "' . static::$entityClass  . '"!');
        }

        $this->append($item);
    }
}
