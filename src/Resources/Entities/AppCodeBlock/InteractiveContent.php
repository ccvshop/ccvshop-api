<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

class InteractiveContent
{
    public ?ViewCollection $views = null;
    public const elementObjects = ['views' => \CCVShop\Api\Resources\Entities\AppCodeBlock\ViewCollection::class];
}
