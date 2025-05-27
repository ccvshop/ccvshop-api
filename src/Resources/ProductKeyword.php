<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductKeywords;

class ProductKeyword extends BaseResource
{
    //SONAR_IGNORE_START
    public ?string $keyword = null;
    //SONAR_IGNORE_END

    public function getEndpoint(): ProductKeywords
    {
        return $this->client->productKeywords;
    }
}
