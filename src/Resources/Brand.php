<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Brands;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Brand extends BaseResource
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $name = null;
    public \stdClass $products;
    public \stdClass $parent;

    public function getEndpoint(): Brands
    {
        return $this->client->brands;
    }
}
