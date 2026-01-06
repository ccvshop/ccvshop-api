<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductProperties;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductProperty extends BaseResource implements PostData, PatchData
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href = null;
    public ?int $id = null;
    public ?int $parent = null;
    public string $name;
    public ?string $description;
    public ?int $position = null;
    public string $type;
    /** @var array<int, object>|null */
    public ?array $children = [];

    // SONAR_IGNORE_END

    public function getEndpoint(): ProductProperties
    {
        return $this->client->productProperties;
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
            'type' => $this->type,
            'parent' => $this->parent,
            'position' => $this->position,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
