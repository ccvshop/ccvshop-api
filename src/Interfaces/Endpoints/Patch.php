<?php

namespace CCVShop\Api\Interfaces\Endpoints;

use CCVShop\Api\BaseResource;

interface Patch
{
    public function patch(?BaseResource $resource = null): void;
}
