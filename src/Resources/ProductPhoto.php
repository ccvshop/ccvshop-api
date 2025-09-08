<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductPhotos;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductPhoto extends BaseResource implements PostData
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
    public ?string $href = null;
    public ?int $id = null;
    public ?string $filename = null;
    public ?string $alttext = null;
    public bool $is_mainphoto = false;
    public ?string $file_type = null;
    public ?string $source = null;
    public ?string $deeplink = null;
    public ?\stdClass $parent = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): ProductPhotos
    {
        return $this->client->productPhotos;
    }

    /**
     * @return array<string,string|bool>
     */
    public function getPostData(): array
    {
        $data = [
            'file_type' => $this->file_type,
            'alttext' => $this->alttext,
            'source' => $this->source,
            'is_mainphoto' => $this->is_mainphoto,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
