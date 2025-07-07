<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Webshops;
use DateTime;

class Webshop extends BaseResource
{
    public ?string $href                = null;
    public ?int    $id                  = null;
    public ?DateTime    $create_date    = null;
    public ?string $name                = null;
    public ?bool   $is_multishop_system = null;
    public ?bool   $is_salespos         = null;
    public ?int    $product_limit       = null;
    public ?int    $product_limit_left  = null;
    public ?string $api_root            = null;

     public array $dates = ['create_date'];

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
