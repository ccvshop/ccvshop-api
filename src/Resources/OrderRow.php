<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;

class OrderRow extends BaseResource
{
    /**
     * @var string|null
     */
    public ?string $href;

    /**
     * @var int|null
     */
    public ?int $id;

    /**
     * @var int|null
     */
    public ?int $order_id;

    /**
     * @var string|null
     */
    public ?string $product_type;

    /**
     * @var string|null
     */
    public ?string $product_name;

    /**
     * @var string|null
     */
    public ?string $product_name_google;

    /**
     * @var string|null
     */
    public ?string $product_number;

    /**
     * @var string|null
     */
    public ?string $sub_product_number;

    /**
     * @var string|null
     */
    public ?string $sub_sku_number;

    /**
     * @var string|null
     */
    public ?string $sub_ean_number;

    /**
     * @var int|null
     */
    public ?int $product_id;

    /**
     * @var string|null
     */
    public ?string $product_href;

    /**
     * @var float|null
     */
    public ?float $count;

    /**
     * @var float|null
     */
    public ?float $price;

    /**
     * @var float|null
     */
    public ?float $product_purchase_price;

    /**
     * @var float|null
     */
    public ?float $discount;

    /**
     * @var bool
     */
    public ?bool $custom_price;

    /**
     * @var float|null
     */
    public ?float $tax;

    /**
     * @var string|null
     */
    public ?string $unit;

    /**
     * @var float|null
     */
    public ?float $weight;

    /**
     * @var string|null
     */
    public ?string $memo;

    /**
     * @var int|null
     */
    public ?int $package_id;

    /**
     * @var string|null
     */
    public ?string $package_name;

    /**
     * @var string|null
     */
    public ?string $stock_location;

    /**
     * @var string|null
     */
    public ?string $supplier;

    /**
     * @var float|null
     */
    public ?float $user_discount;

    /**
     * @var float|null
     */
    public ?float $original_price;

    /**
     * @var float|null
     */
    public ?float $selling_price;

    /**
     * @var float|null
     */
    public ?float $price_without_discount;

    /**
     * @var float|null
     */
    public ?float $price_without_discount_with_attributes;

    /**
     * @var float|null
     */
    public ?float $total_price;

    /**
     * @var float|null
     */
    public ?float $total_extra_option_price;

    /**
     * @var float|null
     */
    public ?float $price_with_attributes;

    /**
     * @var float|null
     */
    public ?float $total_price_with_attributes;

    /**
     * @var string|null
     */
    public ?string $calculator_href;

    /**
     * @var array|null
     */
    public ?array $attributes;

    /**
     * @var array|null
     */
    public ?array $uploads;

    /**
     * @var \stdClass|null
     */
    public ?\stdClass $parent;

    /**
     *
     * @return \CCVShop\Api\Endpoints\OrderRows
     */
    public function getEndpoint(): \CCVShop\Api\Endpoints\OrderRows
    {
        return $this->client->orderrows;
    }
}
