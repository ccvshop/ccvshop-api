<?php

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlock;

class View extends AppCodeBlock
{
    public ?string $name = null;
    public ?string $endpoint = null;
    public ?ElementCollection $elements = null;

    public static array $entities = ['elements' => \CCVShop\Api\Resources\Entities\AppCodeBlock\ElementCollection::class];
}
