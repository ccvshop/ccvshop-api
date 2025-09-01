<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources\Entities\AppCodeBlock;

use CCVShop\Api\Resources\Entities\AppCodeBlockCollection;

class ViewCollection extends AppCodeBlockCollection
{
    public static string $entityClass = View::class;
}
