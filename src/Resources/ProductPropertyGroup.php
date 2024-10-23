<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPropertyGroups;
use stdClass;

class ProductPropertyGroup extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href              = null;
    public ?int    $id                = null;
    public string  $name;
    public ?string $productproperties = null;

    public ?stdClass $parent = null;

    //SONAR_IGNORE_END

    public function getEndpoint(): ProductPropertyGroups
    {
        return $this->client->productPropertyGroups;
    }
}
