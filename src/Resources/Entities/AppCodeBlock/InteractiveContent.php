<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\BaseEntity;

class InteractiveContent extends BaseEntity
{
    public ?ViewCollection $views    = null;
    public static array    $entities = ['views' => ViewCollection::class];
}
