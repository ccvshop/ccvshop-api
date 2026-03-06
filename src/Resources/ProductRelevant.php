<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductsRelevant;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductRelevant extends BaseResource implements PostData
{
    // SONAR_IGNORE_START
    public ?int $id = null;
    public ?string $href = null;
    public ?int $child_product_id = null;
    public ?int $parent_product_id = null;
    public ?object $child_product = null;
    public ?object $parent_product = null;
    // SONAR_IGNORE_END

    public function getEndpoint(): ProductsRelevant
    {
        return $this->client->productsRelevant;
    }

    /**
     * @return array<string,int>
     */
    public function getPostData(): array
    {
        $data = [
            'child_product_id' => $this->child_product_id,
        ];

        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
