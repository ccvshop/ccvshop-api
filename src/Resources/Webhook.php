<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Webhooks;

class Webhook extends BaseResource
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $createdate = null;
    public ?string $event = null;
    public ?string $address = null;
    public ?string $key = null;
    public ?bool $is_active = null;

    public function getEndpoint(): Webhooks
    {
        return $this->client->webhooks;
    }
}
