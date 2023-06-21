<?php

namespace CCVShop\Api\Interfaces\Endpoints;

use CCVShop\Api\BaseResource;

interface Get
{
    public function get(int $id): BaseResource;
}
