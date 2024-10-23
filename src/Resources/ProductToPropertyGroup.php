<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductToPropertyGroups;

class ProductToPropertyGroup extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href                        = null; // Link to self (Format: URI)
    public ?int    $id                          = null; // Unique id of the resource (Minimum: 1)
    public ?int    $product_id                  = null; // Unique id of the product (Minimum: 1)
    public ?int    $product_property_group_id   = null; // Unique id of the product property group
    public ?string $product_href                = null; // Link to product (Format: URI)
    public ?string $product_property_group_href = null; // Link to Product Property Group (Format: URI)
    public ?object $values                      = null; // Product values

    //SONAR_IGNORE_END

    public function getEndpoint(): ProductToPropertyGroups
    {
        return $this->client->productToPropertyGroups;
    }
}
