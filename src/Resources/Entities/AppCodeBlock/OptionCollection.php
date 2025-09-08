<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlockCollection;

class OptionCollection extends AppCodeBlockCollection
{
    public static string $entityClass = Option::class;
}
