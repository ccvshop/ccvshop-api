<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Categories;

class Category extends BaseResource
{
    //SONAR_IGNORE_START
    public ?int    $id                  = null;
    public ?string $name                = null;
    public ?string $description         = null;
    public ?string $description_bottom  = null;
    public ?string $searchwords         = null;
    public ?string $meta_description    = null;
    public ?string $meta_keywords       = null;
    public ?string $page_title          = null;
    public ?string $alias               = null;

    //SONAR_IGNORE_END
    public array $permissions = [];

    public function getEndpoint(): Categories
    {
        return $this->client->categories;
    }
}
