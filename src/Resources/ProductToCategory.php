<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductToCategory extends BaseResource implements PostData
{
    // SONAR_IGNORE_START
    public ?string $href = null; // Link to self (Format: URI)
    public ?int $id = null; // Unique id of the resource (Minimum: 1)
    public ?int $position = null; // Position of product in category
    public ?int $product_id = null; // Unique id of the product (Minimum: 1)
    public ?int $category_id = null; // Unique id of the category
    public ?string $product_href = null; // Link to product (Format: URI)
    public ?string $category_href = null; // Link to category (Format: URI)

    // SONAR_IGNORE_END

    public function getEndpoint(): \CCVShop\Api\Endpoints\ProductToCategories
    {
        return $this->client->productToCategories;
    }

    /**
     * retrieve the category id's for this product.
     *
     * @return ProductToCategoriesCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getProductToCategories(): ProductToCategoriesCollection
    {
        return $this->client->productToCategories->getForProductId($this->product_id);
    }

    /**
     * @return array<string,int>
     */
    public function getPostData(): array
    {
        $data = [
            'category_id' => $this->category_id,
            'product_id' => $this->product_id,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
