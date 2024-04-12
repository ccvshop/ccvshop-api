<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlock;

class Option extends AppCodeBlock
{
    /**
     * @description could either be an string or a object.
     * @var mixed $label
     */
    public $label = null;
    public ?string $value = null;
    public ?bool $selected = null;
}
