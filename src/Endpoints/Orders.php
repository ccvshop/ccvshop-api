<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;

class Orders extends BaseEndpoint
{
    protected string $resourcePath = 'orders';

    protected function getResourceObject(): BaseResource
    {
        return new \CCVShop\Api\Resources\Order($this->client);
    }

    protected function getResourceCollectionObject(): BaseResourceCollection
    {
        return new \CCVShop\Api\Resources\OrderCollection($this->client);
    }
}
