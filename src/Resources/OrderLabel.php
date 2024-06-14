<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\OrderLabels;

class OrderLabel extends BaseResource
{

    public ?string $href = null;
    public ?Entities\Label\Items $items = null;
    public ?array $labels = null;
    public array $permissions = [];

    public function getEndpoint(): OrderLabels
    {
        return $this->client->orderLabels;
    }
}
