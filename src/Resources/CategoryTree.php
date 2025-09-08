<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class CategoryTree extends BaseResource
{
    // SONAR_IGNORE_START
    public string $href = '';   // Link to self (Format: URI)
    /** @var array<int,object> */
    public array $root_categories = [];   // Array with root categories

    // SONAR_IGNORE_END

    public function getEndpoint(): \CCVShop\Api\Endpoints\CategoryTree
    {
        return $this->client->categoryTree;
    }
}
