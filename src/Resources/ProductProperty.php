<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductProperties;

class ProductProperty extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href = null;
    public ?int $id = null;
    public ?int $parent = null;
    public string $name;
    public ?string $description;
    public ?int $position = null;
    public string $type;

    //SONAR_IGNORE_END

    public function getEndpoint(): ProductProperties
    {
        return $this->client->productProperties;
    }
}
