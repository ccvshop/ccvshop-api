<?php

declare(strict_types=1);

namespace CCVShop\Api\Interfaces\Endpoints;

use CCVShop\Api\BaseResourceCollection;

interface GetFor
{
    public function getFor(): BaseResourceCollection;
}
