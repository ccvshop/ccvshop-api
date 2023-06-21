<?php

namespace CCVShop\Api\Interfaces\Endpoints;

use CCVShop\Api\BaseResourceCollection;

interface GetAll
{
    public function getAll(array $parameters = []): BaseResourceCollection;
}
