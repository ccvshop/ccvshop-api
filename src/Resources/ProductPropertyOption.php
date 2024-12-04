<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPropertyOptions;

class ProductPropertyOption extends BaseResource
{
    //SONAR_IGNORE_START
    public ?string $href     = null;
    public ?int    $id       = null;
    public string  $name;
    public ?int    $position = null;
    //SONAR_IGNORE_END

    public function getEndpoint(): ProductPropertyOptions
    {
        return $this->client->productPropertyOptions;
    }
}
