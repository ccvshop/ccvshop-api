<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlock;

class Element extends AppCodeBlock
{
    public ?string $name = null;
    /**
     * @description could either be an string or a object.
     * @var mixed $label
     */
    public $label;
    public ?string $element_type = null;
    /**
     * @description could either be an string or a object.
     * @var mixed $value
     */
    public $value;
    public ?string $deeplink = null;
    public ?string $icon = null;
    public ?string $action = null;
    public ?OptionCollection $options = null;

    public static array $entities = ['options' => \CCVShop\Api\Resources\Entities\AppCodeBlock\OptionCollection::class];
}
