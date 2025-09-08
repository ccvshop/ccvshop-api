<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductKeywords;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductKeyword extends BaseResource implements PostData
{
    // SONAR_IGNORE_START
    public ?string $keyword = null;
    // SONAR_IGNORE_END

    public function getEndpoint(): ProductKeywords
    {
        return $this->client->productKeywords;
    }

    /**
     * @return array<string,string>
     */
    public function getPostData(): array
    {
        $data = [
            'keyword' => $this->keyword,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function (?string $value) {
            return ! is_null($value);
        });
    }
}
