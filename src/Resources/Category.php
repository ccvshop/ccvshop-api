<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Categories;

class Category extends BaseResource
{
    //SONAR_IGNORE_START
    public ?int    $id                        = null; // Unique id of the resource
    public ?string $name                      = null; // Category name
    public ?string $description               = null; // Category description
    public ?string $description_photo_size    = null; // Category description photo size
    public ?string $description_photo_position= null; // Category description photo position
    public ?string $description_photo         = null; // Category description photo
    public ?string $description_bottom        = null; // Category description on the bottom of the page
    public ?string $searchwords               = null; // Search keywords
    public ?string $photo                     = null; // Link to the photo (Format: URI)
    public ?bool   $show_big_photo            = null; // Show a larger photo on mouseover
    public ?bool   $productphoto_in_canvas    = null; // Product photos zoomed/cropped onto canvas
    public ?bool   $show_orderbutton          = null; // Show product order button
    public ?string $orderby                   = null; // Order in which products are sorted
    public ?int    $items_per_page            = null; // Number of items per page
    public ?int    $position                  = null; // Category position
    public ?object $layout_of_products        = null; // Layout of products in this category
    public ?int    $layout_of_categories_id   = null; // Layout id of subcategories in this category
    public ?bool   $show_on_website           = null; // Category visible on website
    public ?int    $color                     = null; // Color scheme number
    public ?int    $color_alternative         = null; // Alternative color scheme
    public ?string $meta_description          = null; // Metatag Description
    public ?string $meta_keywords             = null; // Metatag Keywords
    public ?string $page_title                = null; // Page title
    public ?bool   $no_index                  = null; // Metatag robots: No-Index
    public ?bool   $no_follow                 = null; // Metatag robots: No-Follow
    public ?string $alias                     = null; // SEO Alias of this resource
    public ?object $producttocategories       = null; // Category products (link)
    public ?string $deeplink                  = null; // Deeplink to this resource
    public ?object $categories                = null; // Children categories of this category
    public ?object $parentcategory            = null; // Parent category
    public ?object $parent                    = null; // Parent resource of this resource
    //SONAR_IGNORE_END

    public array $permissions = [];

    public function getEndpoint(): Categories
    {
        return $this->client->categories;
    }
}
