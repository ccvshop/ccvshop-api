<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Products;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Product extends BaseResource implements PatchData, PostData
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
    public ?string $href = null;
    public ?int $id = null;
    public ?bool $is_active = null; // GET geeft is_active
    public ?bool $active = null; // POST heeft active
    public ?\DateTime $createdate = null;
    public ?\DateTime $modifydate = null;
    public ?string $productnumber = null;
    public ?string $eannumber = null;
    public ?string $mpnnumber = null;
    public ?bool $is_multishop_product = null;
    public ?int $multishop_product_id = null;
    public ?string $multishop_href = null;
    public ?string $name = null;
    public ?string $shortdescription = null;
    public ?string $description = null;
    public ?string $taxtariff = null;
    public ?\stdClass $tradecodesystem = null;
    public ?float $price = null;
    public ?float $discount = null;
    public ?float $purchaseprice = null;
    public ?float $container_deposit_price = null;
    public ?float $safety_deposit_price = null;
    public ?\stdClass $productshippingcosts = null;
    public ?int $credit_points_custom = null;
    public ?int $credit_points_calculated = null;
    public ?string $unit = null;
    public ?bool $stockenabled = null;
    public ?string $stocktype = null;
    public ?float $stock = null;
    public ?string $stocklocation = null;
    public ?string $ordering_without_stock = null;
    public ?float $weight = null;
    public ?string $maincategory = null;
    public ?string $subcategory = null;
    /** @var \stdClass|string|null */
    public $brand;
    public ?int $brand_id = null;
    /** @var \stdClass|string|null */
    public $condition;
    public ?int $condition_id = null;
    public ?\stdClass $color = null;
    public ?int $color_id = null;
    public ?string $productmainphoto = null;
    public ?string $meta_description = null;
    public ?string $meta_keywords = null;
    public ?string $page_title = null;
    public ?bool $no_index = null;
    public ?bool $no_follow = null;
    public ?string $alias = null;
    public ?string $deeplink = null;
    public ?string $specs = null;
    public ?int $decimal_amount = null;
    /** @var \stdClass|string|null */
    public $supplier;
    public ?int $supplier_id = null;
    public ?\stdClass $package = null;
    public ?int $package_id = null;
    public ?float $amount_sold = null;
    public ?float $minimal_order_amount = null;
    public ?int $stock_delivery_number = null;
    public ?string $stock_delivery_type = null;
    public ?string $stock_delivery_standard = null;
    public ?bool $show_in_template = null;
    public ?bool $show_on_beginpage = null;
    public ?bool $show_on_facebook = null;
    public ?string $show_order_button = null;
    public ?int $product_layout = null;
    public ?string $hide_without_category = null;
    public ?string $memo = null;
    public ?string $photo_size = null;
    public ?string $google_shopping_category = null;
    public ?bool $is_included_for_export_feed = null;
    public ?bool $fixed_staggered_prices = null;
    public ?bool $marktplaats_active = null;
    public ?string $marktplaats_status = null;
    public ?float $marktplaats_cpc = null;
    public ?float $marktplaats_daily_budget = null;
    public ?float $marktplaats_total_budget = null;
    public ?int $marktplaats_category_id = null;
    public ?string $marktplaats_price_type = null;
    public ?bool $is_visible = null;
    public ?bool $can_be_ordered = null;
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
    // SONAR_IGNORE_END

    /** @var string[] */
    public array $dates = ['createdate', 'modifydate'];

    public const TAX_TARIF_NORMAL = 'normal';
    public const TAX_TARIF_LOW_A = 'low a';
    public const TAX_TARIF_LOW_B = 'low b';
    public const TAX_TARIF_EXTRA_LOW = 'extra low';
    public const TAX_TARIF_ZERO = 'zero';

    public function getEndpoint(): Products
    {
        return $this->client->products;
    }

    /**
     * retrieve the photos for this product.
     *
     * @return ProductPhotosCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function getProductPhotos(): ProductPhotosCollection
    {
        return $this->client->productPhotos->getFor($this);
    }

    /**
     * @return array<string,bool|float|int|\stdClass|string>
     */
    public function getPatchData(): array
    {
        return $this->getPostData();
    }

    /**
     * @return array<string,bool|float|int|\stdClass|string>
     */
    public function getPostData(): array
    {
        $data = [
            'name' => $this->name,
            'productnumber' => $this->productnumber,
            'active' => $this->active,
            'eannumber' => $this->eannumber,
            'description' => $this->description,
            'taxtariff' => $this->taxtariff,
            'price' => $this->price,
            'discount' => $this->discount,
            'purchaseprice' => $this->purchaseprice,
            'container_deposit_price' => $this->container_deposit_price,
            'safety_deposit_price' => $this->safety_deposit_price,
            'credit_points_custom' => $this->credit_points_custom,
            'unit' => $this->unit,
            'stockenabled' => $this->stockenabled,
            'stocktype' => $this->stocktype,
            'stock' => $this->stock,
            'stocklocation' => $this->stocklocation,
            'ordering_without_stock' => $this->ordering_without_stock,
            'weight' => $this->weight,
            'brand' => $this->brand,
            'brand_id' => $this->brand_id,
            'condition' => $this->condition,
            'condition_id' => $this->condition_id,
            'color_id' => $this->color_id,
            'maincategory' => $this->maincategory,
            'subcategory' => $this->subcategory,
            'package_id' => $this->package_id,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'no_index' => $this->no_index,
            'no_follow' => $this->no_follow,
            'alias' => $this->alias,
            'specs' => $this->specs,
            'decimal_amount' => $this->decimal_amount,
            'amount_sold' => $this->amount_sold,
            'minimal_order_amount' => $this->minimal_order_amount,
            'stock_delivery_number' => $this->stock_delivery_number,
            'stock_delivery_type' => $this->stock_delivery_type,
            'stock_delivery_standard' => $this->stock_delivery_standard,
            'show_in_template' => $this->show_in_template,
            'show_on_beginpage' => $this->show_on_beginpage,
            'show_on_facebook' => $this->show_on_facebook,
            'show_order_button' => $this->show_order_button,
            'product_layout' => $this->product_layout,
            'photo_size' => $this->photo_size,
            'hide_without_category' => $this->hide_without_category,
            'memo' => $this->memo,
            'supplier_id' => $this->supplier_id,
            'fixed_staggered_prices' => $this->fixed_staggered_prices,
            'marktplaats_active' => $this->marktplaats_active,
            'marktplaats_status' => $this->marktplaats_status,
            'marktplaats_cpc' => $this->marktplaats_cpc,
            'marktplaats_daily_budget' => $this->marktplaats_daily_budget,
            'marktplaats_total_budget' => $this->marktplaats_total_budget,
            'marktplaats_category_id' => $this->marktplaats_category_id,
            'marktplaats_price_type' => $this->marktplaats_price_type,
            'google_shopping_category' => $this->google_shopping_category,
            'is_included_for_export_feed' => $this->is_included_for_export_feed,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
