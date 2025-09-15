<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlock;

class View extends AppCodeBlock
{
    public ?string $name = null;
    public ?string $endpoint = null;
    public ?ElementCollection $elements = null;
    /** @var array<string, string> */
    public static array $entities = ['elements' => ElementCollection::class];
}
