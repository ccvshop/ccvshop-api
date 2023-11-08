<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Apps;

class App extends BaseResource
{
    public function getEndpoint(): Apps
    {
        return $this->client->apps;
    }
}
