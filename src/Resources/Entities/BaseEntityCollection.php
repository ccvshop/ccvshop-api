<?php

namespace CCVShop\Api\Resources\Entities;

use ArrayObject;
use InvalidArgumentException;

abstract class BaseEntityCollection extends ArrayObject implements Entity
{

    public static $entityClass;

    /**
     * @param array $array
     * @param int $flags
     * @param string $iteratorClass
     */
    public function __construct(array $array = [], int $flags = ArrayObject::ARRAY_AS_PROPS, string $iteratorClass = 'ArrayIterator')
    {
        parent::__construct($array, $flags, $iteratorClass);
    }

    /**
     * @param BaseEntity $item
     * @return $this
     */
    public function addItem(BaseEntity $item): self
    {
        if (!$item instanceof static::$entityClass) {
            throw new InvalidArgumentException('$item (' . get_class($item) . ') does not equal "' . static::$entityClass . '"!');
        }

        $this->append($item);
        return $this;
    }
}
