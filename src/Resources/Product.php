<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Products;
use CCVShop\Api\Resources\Call\Post;
use GuzzleHttp\Client;

class Product extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
    public ?string $href = null;
    public ?int $id = null;
    public bool $is_active = false;
    public ?\DateTime $createdate = null;
    public ?\DateTime $modifydate = null;
    public ?string $productnumber = null;
    public ?string $eannumber = null;
    public ?string $mpnnumber = null;
    public bool $is_multishop_product = false;
    public ?int $multishop_product_id  = null;
    public ?string $multishop_href = null;
    public ?string $name = null;
    public ?string $shortdescription  = null;
    public ?string $description = null;
    public ?string $taxtariff = null;
    public ?\stdClass $tradecodesystem = null;
    public ?string $price = null;
    public ?string $discount = null;
    public ?string $purchaseprice = null;
    public ?string $container_deposit_price = null;
    public ?string $safety_deposit_price = null;
    public ?\stdClass $productshippingcosts = null;
    public ?int $credit_points_custom = null;
    public ?int $credit_points_calculated = null;
    public ?string $unit = null;
    public ?string $stockenabled = null;
    public ?string $stocktype = null;
    public ?string $stock = null;
    public ?string $stocklocation = null;
    public ?string $ordering_without_stock = null;
    public ?string $weight = null;
    public ?string $maincategory = null;
    public ?string $subcategory = null;
    public ?\stdClass $brand  = null;
    public ?\stdClass $condition = null;
    public ?\stdClass $color = null;
    public ?string $productmainphoto = null;
    public ?string $meta_description = null;
    public ?string $meta_keywords = null;
    public ?string $page_title = null;
    public bool $no_index = false;
    public bool $no_follow = false;
    public ?string $alias = null;
    public ?string $deeplink = null;
    public ?string $specs = null;
    public ?int $decimal_amount= null;
    public ?string $amount_sold = null;
    public ?string $minimal_order_amount = null;
    public ?int $stock_delivery_number = null;
    public ?string $stock_delivery_type = null;
    public bool $show_in_template = false;
    public bool $show_on_beginpage = false;
    public bool $show_on_facebook = false;
    public ?string $show_order_button = null;
    public ?string $product_layout = null;
    public ?string $hide_without_category = null;
    public ?string $memo = null;
    public ?string $photo_size = null;
    public ?string $google_shopping_category = null;
    public ?\stdClass $package = null;
    public ?\stdClass $supplier = null;
    public bool $is_included_for_export_feed = false;
    public bool $fixed_staggered_prices = false;
    public bool $is_visible = false;
    public bool $can_be_ordered = false;
    public ?\stdClass $productlabels = null;
    public ?\stdClass $productphotos = null;
    public ?\stdClass $productvariations = null;
    public ?\stdClass $productvideos = null;
    public ?\stdClass $producttaxtariffexceptions = null;
    public ?\stdClass $productattachments = null;
    public ?\stdClass $productkeywords = null;
    public ?\stdClass $productrelevant = null;
    public ?\stdClass $productattributesets = null;
    public ?\stdClass $productstaggeredprices = null;
    public ?\stdClass $producttocategories = null;
    public ?\stdClass $productreviews = null;
    public ?\stdClass $webshops = null;
    public ?\stdClass $attributecombinations = null;
    public ?\stdClass $producttopropertygroups = null;
    //SONAR_IGNORE_END
    public array $permissions = [];
    public array $dates = ['createdate', 'modifydate'];

    public function getEndpoint(): Products
    {
        return $this->client->products;
    }

    /**
     * retrieve the photos for this product
     * @return ProductPhotosCollection
     * @throws \CCVShop\Api\Exceptions\InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getProductPhotos(): ProductPhotosCollection
    {
        return $this->client->productPhotos->getFor($this);
    }
}
