<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\BaseResourceCollection;

class ViewCollection extends \ArrayObject
{
    protected array $items = [];
    public static $entityClass = \CCVShop\Api\Resources\Entities\AppCodeBlock\View::class;

    public function AddItem($item): void
    {
        if (!get_class($item) != static::$entityClass) {
            throw new \InvalidArgumentException('$item (' .  get_class($item) . ') does not equal "' . static::$entityClass  . '"!');
        }

        $this->items = $item;
    }
}
