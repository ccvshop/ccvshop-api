<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPhotos;
use CCVShop\Api\Resources\Call\Post;
use GuzzleHttp\Client;

class ProductPhoto extends BaseResource
{
    public ?string $href = null;
    public ?int $id = null;
    public ?string $filename = null;
    public ?string $alttext = null;
    public bool $is_mainphoto = false;
    public ?string $deeplink = null;
    public ?\stdClass $parent = null;
    public array $permissions = [];

    public function getEndpoint(): ProductPhotos
    {
        return $this->client->productPhotos;
    }
}
