<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\BaseEntity;

class Option extends BaseEntity
{
    public $label = null; //TODO:: string|object typecasting {nl:'nl tekst', en: 'ENNGLISH'}
    public ?string $value = null;
    public ?bool $selected = null;
}
