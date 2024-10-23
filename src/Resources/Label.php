<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Labels;

class Label extends BaseResource
{
    public ?int    $id               = null;
    public ?string $image_location   = null;
    public ?string $tooltip          = null;
    public bool    $show_on_products = false;
    public bool    $show_on_orders   = false;
    public bool    $show_on_invoices = false;
    public array   $permissions      = [];

    public function getEndpoint(): Labels
    {
        return $this->client->labels;
    }
}
