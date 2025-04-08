<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductAttributesValues;

class ProductAttributeValue extends BaseResource
{
    public ?int    $id               = null;
    public ?int    $optionid         = null;
    public ?int    $optionvalue_id   = null;
    public ?string $optionvalue_name = null;
    public ?string $optionname       = null;
    public ?int    $optionposition   = null;
    public ?int    $price            = null;


    public function getEndpoint(): ProductAttributesValues
    {
        return $this->client->productAttributes;
    }
}
