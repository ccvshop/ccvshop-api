<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Resources\FiscalTransactionSignature;
use CCVShop\Api\Resources\FiscalTransactionSignatureCollection;

class ElementCollection extends \ArrayObject
{
    protected array $items = [];
    public static $entityClass = \CCVShop\Api\Resources\Entities\AppCodeBlock\Element::class;
    public function AddItem($item): void
    {
        if (!get_class($item) != static::$entityClass) {
            throw new \InvalidArgumentException('$item (' .  get_class($item) . ') does not equal "' . static::$entityClass  . '"!');
        }

        $this->items = $item;
    }
}
