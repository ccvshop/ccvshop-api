<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlock;

class Option extends AppCodeBlock
{
    /**
     * @description could either be an string or a object.
     * @var mixed $label
     */
    public         $label;
    public ?string $value    = null;
    public ?bool   $selected = null;
}
