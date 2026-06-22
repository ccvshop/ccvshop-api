<?php

declare(strict_types=1);

namespace CCVShop\Api\Interfaces\Endpoints;

use CCVShop\Api\BaseResourceCollection;

interface GetAll
{
    /**
     * @param array<string, int|float|string> $parameters
     *
     * @return BaseResourceCollection
     */
    public function getAll(array $parameters = []): BaseResourceCollection;
}
