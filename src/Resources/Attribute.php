<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Attributes;
use GuzzleHttp\Client;

class Attribute extends BaseResource
{
    public ?int    $id   = null;
    public ?string $href = null;
    public ?string $name = null;
    public ?string $type = null;

    /**
     * @return Attributes
     */
    public function getEndpoint(): Attributes
    {
        return $this->client->attributes;
    }
}
