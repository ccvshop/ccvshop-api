<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPropertyValues;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductPropertyValue extends BaseResource implements PatchData, PostData
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href = null;
    public ?int $id = null;
    public ?int $product_id = null;
    public ?int $product_property_id = null;
    public string $value;

    // SONAR_IGNORE_END

    public function getEndpoint(): ProductPropertyValues
    {
        return $this->client->productPropertyValues;
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPatchData(): array
    {
        $data = [
            'value' => $this->value,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function (?string $value) {
            return $value !== null;
        });
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPostData(): array
    {
        $data = [
            'product_id' => $this->product_id,
            'product_property_id' => $this->product_property_id,
            'value' => $this->value,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
