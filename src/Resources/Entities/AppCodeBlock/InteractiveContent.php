<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\ViewCollection;

abstract class InteractiveContent
{
    public ?ViewCollection $views = null;
    public array $elementObjects = ['views' => \CCVShop\Api\Resources\ViewCollection::class];
}
