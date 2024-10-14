<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Products;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Resources\Call\Post;
use GuzzleHttp\Client;
use JsonException;
use ReflectionException;

class ProductToCategory extends BaseResource
{
    //SONAR_IGNORE_START
    public ?string $href = null; // Link to self (Format: URI)
    public ?int $id = null; // Unique id of the resource (Minimum: 1)
    public ?int $position = null; // Position of product in category
    public ?int $product_id = null; // Unique id of the product (Minimum: 1)
    public ?int $category_id = null; // Unique id of the category
    public ?string $product_href = null; // Link to product (Format: URI)
    public ?string $category_href = null; // Link to category (Format: URI)

    //SONAR_IGNORE_END


    public function getEndpoint(): Products
    {
        return $this->client->productToCategories;
    }

    /**
     * retrieve the category id's for this product
     * @return ProductToCategoriesCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getProductToCategories(): ProductToCategoriesCollection
    {
        return $this->client->productToCategories->getFor($this);
    }
}
