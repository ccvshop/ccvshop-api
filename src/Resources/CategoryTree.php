<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;

class CategoryTree extends BaseResource
{
    //SONAR_IGNORE_START
    public ?int    $id              = null; // Unique id of the resource
    public ?string $name            = null; // Category name (Maxlength: 255)
    public ?string $description     = null; // Category description (Maxlength: 65536)
    public ?int    $position        = null; // Category position (Minimum: 0)
    public ?bool   $show_on_website = null; // Category visible on website
    public ?string $deeplink        = null; // Deeplink to this resource
    public ?array  $children        = [];   // Array with child categories (recursive)
    //SONAR_IGNORE_END

    public array $permissions = [];

    public function getEndpoint(): \CCVShop\Api\Endpoints\CategoryTree
    {
        return $this->client->categoryTree;
    }
}
