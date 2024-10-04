<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;

class CategoryTree extends BaseResource
{
    //SONAR_IGNORE_START
    public string  $href            = '';   // Link to self (Format: URI)
    public array   $root_categories = [];   // Array with root categories
    //SONAR_IGNORE_END

    public array $permissions = [];

    public function getEndpoint(): \CCVShop\Api\Endpoints\CategoryTree
    {
        return $this->client->categoryTree;
    }
}
