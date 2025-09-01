<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\OrderRows;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class OrderRow extends BaseResource
{
    public ?string $href;
    public ?int $id;
    public ?int $order_id;
    public ?string $product_type;
    public ?string $product_name;
    public ?string $product_name_google;
    public ?string $product_number;
    public ?string $sub_product_number;
    public ?string $sub_sku_number;
    public ?string $sub_ean_number;
    public ?int $product_id;
    public ?string $product_href;
    public ?float $count;
    public ?float $price;
    public ?float $product_purchase_price;
    public ?float $discount;
    public ?bool $custom_price;
    public ?float $tax;
    public ?string $unit;
    public ?float $weight;
    public ?string $memo;

    public ?int $package_id;
    public ?string $package_name;
    public ?string $stock_location;
    public ?string $supplier;
    public ?float $user_discount;
    public ?float $original_price;
    public ?float $selling_price;
    public ?float $price_without_discount;
    public ?float $price_without_discount_with_attributes;
    public ?float $total_price;
    public ?float $total_extra_option_price;
    public ?float $price_with_attributes;
    public ?float $total_price_with_attributes;
    public ?string $calculator_href;
    /** @var array<int, object>|null */
    public ?array $attributes;
    /** @var array<int, object>|null */
    public ?array $uploads;
    public ?\stdClass $parent;

    /**
     * @return OrderRows
     */
    public function getEndpoint(): OrderRows
    {
        return $this->client->orderRows;
    }
}
