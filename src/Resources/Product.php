<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Products;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Resources\Call\Post;
use DateTime;
use GuzzleHttp\Client;
use JsonException;
use stdClass;

class Product extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
    public ?string   $href          = null;
    public ?int      $id            = null;
    public ?bool     $is_active     = null; // GET geeft is_active
    public ?bool      $active                     = null; // POST heeft active
    public ?DateTime $createdate    = null;
    public ?DateTime $modifydate    = null;
    public ?string   $productnumber = null;
    public ?string    $eannumber                   = null;
    public ?string    $mpnnumber                   = null;
    public ?bool      $is_multishop_product        = null;
    public ?int       $multishop_product_id        = null;
    public ?string    $multishop_href              = null;
    public ?string    $name                        = null;
    public ?string    $shortdescription            = null;
    public ?string    $description                 = null;
    public ?string    $taxtariff                  = null;
    public ?stdClass  $tradecodesystem            = null;
    public ?string    $price                      = null;
    public ?string    $discount                    = null;
    public ?string    $purchaseprice               = null;
    public ?string    $container_deposit_price     = null;
    public ?string    $safety_deposit_price       = null;
    public ?stdClass  $productshippingcosts       = null;
    public ?int       $credit_points_custom       = null;
    public ?int       $credit_points_calculated    = null;
    public ?string    $unit                        = null;
    public ?bool      $stockenabled                = null;
    public ?string    $stocktype                   = null;
    public ?string    $stock                       = null;
    public ?string    $stocklocation               = null;
    public ?string    $ordering_without_stock      = null;
    public ?string    $weight                      = null;
    public ?string    $maincategory                = null;
    public ?string    $subcategory                = null;
    public ?stdClass  $brand                      = null;
    public ?int       $brand_id                   = null;
    public ?stdClass  $condition                  = null;
    public ?int       $condition_id               = null;
    public ?stdClass  $color                      = null;
    public ?int       $color_id                   = null;
    public ?string    $productmainphoto            = null;
    public ?string    $meta_description            = null;
    public ?string    $meta_keywords               = null;
    public ?string    $page_title                  = null;
    public ?bool      $no_index                    = null;
    public ?bool      $no_follow                   = null;
    public ?string    $alias                       = null;
    public ?string    $deeplink                    = null;
    public ?string    $specs                       = null;
    public ?int       $decimal_amount             = null;
    public ?stdClass  $supplier                   = null;
    public ?int       $supplier_id                = null;
    public ?stdClass  $package                    = null;
    public ?int       $package_id                 = null;
    public ?string    $amount_sold                 = null;
    public ?string    $minimal_order_amount        = null;
    public ?int       $stock_delivery_number       = null;
    public ?string    $stock_delivery_type         = null;
    public ?string    $stock_delivery_standard     = null;
    public ?bool      $show_in_template            = null;
    public ?bool      $show_on_beginpage           = null;
    public ?bool      $show_on_facebook            = null;
    public ?string    $show_order_button           = null;
    public ?int       $product_layout              = null;
    public ?string    $hide_without_category       = null;
    public ?string    $memo                        = null;
    public ?string    $photo_size                  = null;
    public ?string    $google_shopping_category    = null;
    public ?bool      $is_included_for_export_feed = null;
    public ?bool      $fixed_staggered_prices      = null;
    public ?bool      $marktplaats_active          = null;
    public ?string    $marktplaats_status          = null;
    public ?float     $marktplaats_cpc             = null;
    public ?float     $marktplaats_daily_budget    = null;
    public ?float     $marktplaats_total_budget    = null;
    public ?int       $marktplaats_category_id     = null;
    public ?string    $marktplaats_price_type      = null;
    public ?bool      $is_visible                  = null;
    public ?bool      $can_be_ordered             = null;
    public ?stdClass  $productlabels              = null;
    public ?stdClass  $productphotos              = null;
    public ?stdClass  $productvariations          = null;
    public ?stdClass  $productvideos              = null;
    public ?stdClass  $producttaxtariffexceptions = null;
    public ?stdClass  $productattachments         = null;
    public ?stdClass  $productkeywords            = null;
    public ?stdClass  $productrelevant            = null;
    public ?stdClass  $productattributesets       = null;
    public ?stdClass  $productstaggeredprices     = null;
    public ?stdClass  $producttocategories        = null;
    public ?stdClass  $productreviews             = null;
    public ?stdClass  $webshops                   = null;
    public ?stdClass  $attributecombinations      = null;
    public ?stdClass  $producttopropertygroups    = null;
    //SONAR_IGNORE_END
    public array $permissions = [];
    public array $dates       = ['createdate', 'modifydate'];

    public const TAX_TARIF_NORMAL    = 'normal';
    public const TAX_TARIF_LOW_A     = 'low a';
    public const TAX_TARIF_LOW_B     = 'low b';
    public const TAX_TARIF_EXTRA_LOW = 'extra low';
    public const TAX_TARIF_ZERO      = 'zero';

    public function getEndpoint(): Products
    {
        return $this->client->products;
    }

    /**
     * retrieve the photos for this product
     * @return ProductPhotosCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function getProductPhotos(): ProductPhotosCollection
    {
        return $this->client->productPhotos->getFor($this);
    }
}
