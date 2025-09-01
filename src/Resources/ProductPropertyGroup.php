<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPropertyGroups;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductPropertyGroup extends BaseResource implements PostData, PatchData
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href = null;
    public ?int $id = null;
    public string $name;
    public ?string $productproperties = null;

    public ?\stdClass $parent = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): ProductPropertyGroups
    {
        return $this->client->productPropertyGroups;
    }

    /**
     * @return array<string,string>
     */
    public function getPatchData(): array
    {
        return $this->getPostData();
    }

    /**
     * @return array<string,string>
     */
    public function getPostData(): array
    {
        $data = [
            'name' => $this->name,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function (?string $value) {
            return ! is_null($value);
        });
    }
}
