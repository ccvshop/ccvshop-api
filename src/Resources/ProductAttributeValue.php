<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductAttributesValues;
use stdClass;

class ProductAttributeValue extends BaseResource
{
    //SONAR_IGNORE_START
    // This needs to be ignored to match the API structure exactly.
    public ?int    $id               = null;

    public ?int    $optionid         = null;

    public ?int    $optionvalue_id   = null;

    public ?string $optionvalue_name = null;

    public ?string $optionname       = null;

    public ?int    $optionposition   = null;

    public ?int    $price            = null;

    public ?stdClass    $parent            = null;
    //SONAR_IGNORE_END


    /**
     * @return ProductAttributesValues
     */
    public function getEndpoint(): ProductAttributesValues
    {
        return $this->client->productAttributes;
    }
}
