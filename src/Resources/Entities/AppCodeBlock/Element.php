<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

class Element
{
    public ?string $name = null;
    public ?string $label = null; //TODO:: string|object {nl:'nl tekst', en: 'ENNGLISH'}
    public ?string $element_type = null;
    public ?string $value = null;
    public ?string $deeplink = null;
    public ?string $icon = null;

    public ?array $options = null; //TODO:: dit moet een optionscollection zijn, deze moet nog als resource aangemaakt worden.
    public ?string $action = null;
}
