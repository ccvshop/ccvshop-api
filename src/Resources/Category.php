<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Categories;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Category extends BaseResource implements PatchData, PostData
{
    // SONAR_IGNORE_START
    public ?int $id = null; // Unique id of the resource
    public ?string $name = null; // Category name
    public ?string $description = null; // Category description
    public ?string $description_photo_size = null; // Category description photo size
    public ?string $description_photo_position = null; // Category description photo position
    public ?string $description_photo = null; // Category description photo
    public ?string $description_bottom = null; // Category description on the bottom of the page
    public ?string $searchwords = null; // Search keywords
    public ?string $photo = null; // Link to the photo (Format: URI)
    public ?bool $show_big_photo = null; // Show a larger photo on mouseover
    public ?bool $productphoto_in_canvas = null; // Product photos zoomed/cropped onto canvas
    public ?bool $show_orderbutton = null; // Show product order button
    public ?string $orderby = null; // Order in which products are sorted
    public ?int $items_per_page = null; // Number of items per page
    public ?int $position = null; // Category position
    public ?object $layout_of_products = null; // Layout of products in this category
    public ?int $layout_of_categories_id = null; // Layout id of subcategories in this category
    public ?bool $show_on_website = null; // Category visible on website
    public ?int $color = null; // Color scheme number
    public ?int $color_alternative = null; // Alternative color scheme
    public ?string $meta_description = null; // Metatag Description
    public ?string $meta_keywords = null; // Metatag Keywords
    public ?string $page_title = null; // Page title
    public ?bool $no_index = null; // Metatag robots: No-Index
    public ?bool $no_follow = null; // Metatag robots: No-Follow
    public ?string $alias = null; // SEO Alias of this resource
    public ?object $producttocategories = null; // Category products (link)
    public ?string $deeplink = null; // Deeplink to this resource
    public ?object $categories = null; // Children categories of this category
    public ?object $parentcategory = null; // Parent category

    public ?object $parent = null; // Parent resource of this resource
    public ?string $photo_source = null; // Base 64 encode image source.
    public ?string $photo_file_type = null; // Photo extension.

    // SONAR_IGNORE_END

    public function getEndpoint(): Categories
    {
        return $this->client->categories;
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
            'description' => $this->description,
            'description_bottom' => $this->description_bottom,
            'searchwords' => $this->searchwords,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'page_title' => $this->page_title,
            'alias' => $this->alias,
            'parentcategory_id' => $this->parentcategory->id ?? null,
            'photo_source' => $this->photo_source,
            'photo_file_type' => $this->photo_file_type,
            'show_on_website' => $this->show_on_website,
            'no_index' => $this->no_index,
            'no_follow' => $this->no_follow,
            'items_per_page' => $this->items_per_page,
            'layout_of_categories_id' => $this->layout_of_categories_id,
            'layout_of_products_id' => $this->layout_of_products->id ?? null,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
