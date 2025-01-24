<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPhotos;
use CCVShop\Api\Resources\Call\Post;
use GuzzleHttp\Client;
use stdClass;

class ProductPhoto extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
    public ?string   $href         = null;
    public ?int      $id           = null;
    public ?string   $filename     = null;
    public ?string   $alttext      = null;
    public bool      $is_mainphoto = false;
    public ?string   $file_type    = null;
    public ?string   $source       = null;
    public ?string   $deeplink     = null;
    public ?stdClass $parent       = null;
    //SONAR_IGNORE_END
    public array $permissions = [];

    public function getEndpoint(): ProductPhotos
    {
        return $this->client->productPhotos;
    }
}
