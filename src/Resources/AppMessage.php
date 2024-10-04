<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\AppMessages as EndpointsAppMessage;

class AppMessage extends BaseResource
{
    public ?int     $id         = null;
    public ?int     $app_id     = null;
    public ?int     $website_id = null;
    public ?string  $type       = null;
    public ?int     $read       = null;
    public ?string  $icon       = null;
    public ?string  $message    = null;
    public ?string  $level      = null;

    /**
     * @return EndpointsAppMessage
     */
    public function getEndpoint(): EndpointsAppMessage
    {
        return $this->client->appMessage;
    }
}
