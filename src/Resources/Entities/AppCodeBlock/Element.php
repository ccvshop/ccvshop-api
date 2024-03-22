<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\BaseEntity;

class Element extends BaseEntity
{
    public ?string $name = null;
    public $label = null; //TODO:: string|object typecasting {nl:'nl tekst', en: 'ENNGLISH'}
    public ?string $element_type = null;
    public ?string $value = null;
    public ?string $deeplink = null;
    public ?string $icon = null;
    public ?string $action = null;
    public ?OptionCollection $options = null;
    public static array $elementObjects = ['options' => \CCVShop\Api\Resources\Entities\AppCodeBlock\OptionCollection::class];


}
