<?php

declare(strict_types=1);

namespace CCVShop\Api\Interfaces\Endpoints;

use CCVShop\Api\BaseResource;

interface Post
{
    public function post(): BaseResource;
}
