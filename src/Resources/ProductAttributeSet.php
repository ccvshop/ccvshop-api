<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductAttributeSets;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductAttributeSet extends BaseResource
{
    public ?int $id = null;
    public ?string $attributename = null;
    public ?int $attributeposition = null;
    public ?string $type = null;

    /**
     * @return ProductAttributeSets
     */
    public function getEndpoint(): ProductAttributeSets
    {
        return $this->client->productAttributesSets;
    }
}
