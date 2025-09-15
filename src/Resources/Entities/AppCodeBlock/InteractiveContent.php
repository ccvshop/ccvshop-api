<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\BaseEntity;

class InteractiveContent extends BaseEntity
{
    public ?ViewCollection $views = null;
    /** @var array<string, string> */
    public static array $entities = ['views' => ViewCollection::class];
}
