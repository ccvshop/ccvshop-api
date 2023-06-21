<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Credentials;
use CCVShop\Api\Endpoints\Webshops;

class Webshop extends BaseResource
{
    //SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $id = null;
    public ?string $name = null;
    public ?bool $is_multishop_system = null;
    public ?int $product_limit = null;
    public ?int $product_limit_left = null;
    public ?string $api_root = null;

    //SONAR_IGNORE_END

    public function getEndpoint(): Webshops
    {
        return $this->client->webshops;
    }

    public function getMerchant(): Merchant
    {
        return $this->client->merchant->getFor($this);
    }

    public function postCredentials(array $data): Credential
    {
        return $this->client->credentials->postFor($this, $data);
    }
}
