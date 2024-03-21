<?php

namespace CCVShop\Api\Resources\Entities;

abstract class BaseEntityCollection extends \ArrayObject
{
    protected array $items = [];
    public static $entityClass;

    public function AddItem($item): void
    {
        if (!$item instanceof static::$entityClass) {
            throw new \InvalidArgumentException('$item (' .  get_class($item) . ') does not equal "' . static::$entityClass  . '"!');
        }

        $this->append($item);
    }
}
