<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPropertyValues;

class ProductPropertyValue extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href                = null;
    public ?int    $id                  = null;
    public ?int    $product_id          = null;
    public ?int    $product_property_id = null;
    public string  $value;

    //SONAR_IGNORE_END

    public function getEndpoint(): ProductPropertyValues
    {
        return $this->client->productPropertyValues;
    }
}
