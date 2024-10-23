<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductLabels;

class ProductLabel extends BaseResource
{
    //SONAR_IGNORE_START
    public ?string               $href        = null;
    public ?Entities\Label\Items $items       = null;
    public ?array                $labels      = null;
    public array                 $permissions = [];
    //SONAR_IGNORE_END
    public function getEndpoint(): ProductLabels
    {
        return $this->client->productLabels;
    }
}
