<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPropertyOptions;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductPropertyOption extends BaseResource implements PostData, PatchData
{
    // SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $id = null;
    public string $name;
    public ?int $position = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): ProductPropertyOptions
    {
        return $this->client->productPropertyOptions;
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPatchData(): array
    {
        return $this->getPostData();
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPostData(): array
    {
        $data = [
            'name' => $this->name,
            'position' => $this->position,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
