<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\BaseEntity;

class View extends BaseEntity
{
    public ?string $name = null;
    public ?string $endpoint = null;
    public ?ElementCollection $elements = null;

    public static array $entities = ['elements' => \CCVShop\Api\Resources\Entities\AppCodeBlock\ElementCollection::class];
}
