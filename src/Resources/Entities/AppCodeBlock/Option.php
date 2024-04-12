<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlock;

class Option extends AppCodeBlock
{
    public $label = null; //TODO:: string|object typecasting {nl:'nl tekst', en: 'ENNGLISH'}
    public ?string $value = null;
    public ?bool $selected = null;
}
