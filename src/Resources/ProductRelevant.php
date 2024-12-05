<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductsRelevant;

class ProductRelevant extends BaseResource
{
    //SONAR_IGNORE_START
    public ?int                  $id                = null;
    public ?string               $href              = null;
    public ?int                  $child_product_id  = null;
    public ?int                  $parent_product_id = null;
    public ?object               $child_product     = null;
    public ?object               $parent_product    = null;
    //SONAR_IGNORE_END

    public function getEndpoint(): ProductsRelevant
    {
        return $this->client->productsRelevant;
    }
}
