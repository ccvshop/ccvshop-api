<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductAttributesValues;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductAttributeValue extends BaseResource
{
    // SONAR_IGNORE_START
    // This needs to be ignored to match the API structure exactly.
    public ?int $id = null;

    public ?int $optionid = null;

    public ?int $optionvalue_id = null;

    public ?string $optionvalue_name = null;

    public ?string $optionname = null;

    public ?int $optionposition = null;

    public ?float $price = null;

    public ?\stdClass $parent = null;
    // SONAR_IGNORE_END

    /**
     * @return ProductAttributesValues
     */
    public function getEndpoint(): ProductAttributesValues
    {
        return $this->client->productAttributeValues;
    }
}
