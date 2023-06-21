<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Credentials;
use CCVShop\Api\Resources\Call\Post;
use GuzzleHttp\Client;

class Credential extends BaseResource
{
    //SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $id = null;
    public ?string $createdate = null;
    public ?string $label = null;
    public ?string $api_public = null;
    public ?string $api_secret = null;
    public bool $link_to_main_user = false;
    public array $permissions = [];

    //SONAR_IGNORE_END

    public function getEndpoint(): Credentials
    {
        return $this->client->credentials;
    }
}
