<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Resources\ElementCollection;

abstract class View
{
    public ?string $name = null;
    public ?string $endpoint = null;
    public ?ElementCollection $elements = null;
    public array $elementObjects = ['elements' => \CCVShop\Api\Resources\ElementCollection::class];
}
