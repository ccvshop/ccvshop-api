<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\AppConfig as EndpointsAppConfig;

class AppConfig extends BaseResource
{
    public ?int $id = null;
    public ?int $app_id = null;
    public ?string $type = null;
    public ?string $url = null;
    public ?string $name = null;
    public ?string $website_id = null;

    /**
     * @return EndpointsAppConfig
     */
    public function getEndpoint(): EndpointsAppConfig
    {
        return $this->client->appConfig;
    }
}
