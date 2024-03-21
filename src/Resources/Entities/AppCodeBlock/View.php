<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

class View
{
    public ?string $name = null;
    public ?string $endpoint = null;
    public ?ElementCollection $elements = null;

    public const elementObjects = ['elements' => \CCVShop\Api\Resources\Entities\AppCodeBlock\ElementCollection::class];
}
