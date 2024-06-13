<?php

namespace CCVShop\Api\Interfaces\Endpoints;

interface Put
{
    public function put(int $id, array $parameters = []);
}
