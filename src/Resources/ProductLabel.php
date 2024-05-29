<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductLabels;

class ProductLabel extends BaseResource
{

    public ?string $href = null;
    public ?Entities\ProductLabel\Items $items = null;
    public ?array $labels = null;
    public array $permissions = [];

    public function getEndpoint(): ProductLabels
    {
        return $this->client->productLabels;
    }
}
