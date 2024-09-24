<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\AppConfig;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductCollection;

class Products extends BaseEndpoint implements
    Get,
    GetAll,
    Patch,
    Post
{
    protected string $resourcePath = 'products';

    /**
     * @return Product()
     */
    protected function getResourceObject(): Product
    {
        return new Product($this->client);
    }

    /**
     * @return ProductCollection
     */
    protected function getResourceCollectionObject(): ProductCollection
    {
        return new ProductCollection();
    }

    /**
     * @param int $id
     * @return Product
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): Product
    {
        /** @var Product $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return ProductCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getAll(array $parameters = []): ProductCollection
    {
        /** @var ProductCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param Product|null $product
     * @return void
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function patch(?Product $product = null): void
    {
        if (is_null($product)) {
            throw new \InvalidArgumentException(Product::class . ' required');
        }

        /** @var AppConfig */
        $this->rest_patch($product->id, [
            'shortdescription'  => $product->shortdescription,
            'description'       => $product->description,
            'name'              => $product->name,
            'unit'              => $product->unit,
            'meta_description'  => $product->meta_description,
            'meta_keywords'     => $product->meta_keywords,
            'page_title'        => $product->page_title,
            'alias'             => $product->alias,
        ]);
    }

    public function post(?Product $product = null)
    {
        if (is_null($product)) {
            throw new \InvalidArgumentException(Product::class . ' required');
        }

        /** @var AppConfig */
        $data = [
            'name'                          => $product->name,
            'productnumber'                 => $product->productnumber,
            'active'                        => $product->active,
            'eannumber'                     => $product->eannumber,
            'description'                   => $product->description,
            'taxtariff'                     => $product->taxtariff,
            'price'                         => $product->price,
            'discount'                      => $product->discount,
            'purchaseprice'                 => $product->purchaseprice,
            'container_deposit_price'       => $product->container_deposit_price,
            'safety_deposit_price'          => $product->safety_deposit_price,
            'credit_points_custom'          => $product->credit_points_custom,
            'unit'                          => $product->unit,
            'stockenabled'                  => $product->stockenabled,
            'stocktype'                     => $product->stocktype,
            'stock'                         => $product->stock,
            'stocklocation'                 => $product->stocklocation,
            'ordering_without_stock'        => $product->ordering_without_stock,
            'weight'                        => $product->weight,
            'brand'                         => $product->brand,
            'condition'                     => $product->condition,
            'condition_id'                  => $product->condition_id,
            'color_id'                      => $product->color_id,
            'maincategory'                  => $product->maincategory,
            'subcategory'                   => $product->subcategory,
            'package_id'                    => $product->package_id,
            'meta_description'              => $product->meta_description,
            'meta_keywords'                 => $product->meta_keywords,
            'no_index'                      => $product->no_index,
            'no_follow'                     => $product->no_follow,
            'alias'                         => $product->alias,
            'specs'                         => $product->specs,
            'decimal_amount'                => $product->decimal_amount,
            'amount_sold'                   => $product->amount_sold,
            'minimal_order_amount'          => $product->minimal_order_amount,
            'stock_delivery_number'         => $product->stock_delivery_number,
            'stock_delivery_type'           => $product->stock_delivery_type,
            'stock_delivery_standard'       => $product->stock_delivery_standard,
            'show_in_template'              => $product->show_in_template,
            'show_on_beginpage'             => $product->show_on_beginpage,
            'show_on_facebook'              => $product->show_on_facebook,
            'show_order_button'             => $product->show_order_button,
            'product_layout'                => $product->product_layout,
            'photo_size'                    => $product->photo_size,
            'hide_without_category'         => $product->hide_without_category,
            'memo'                          => $product->memo,
            'supplier_id'                   => $product->supplier_id,
            'fixed_staggered_prices'        => $product->fixed_staggered_prices,
            'marktplaats_active'            => $product->marktplaats_active,
            'marktplaats_status'            => $product->marktplaats_status,
            'marktplaats_cpc'               => $product->marktplaats_cpc,
            'marktplaats_daily_budget'      => $product->marktplaats_daily_budget,
            'marktplaats_total_budget'      => $product->marktplaats_total_budget,
            'marktplaats_category_id'       => $product->marktplaats_category_id,
            'marktplaats_price_type'        => $product->marktplaats_price_type,
            'google_shopping_category'      => $product->google_shopping_category,
            'is_included_for_export_feed'   => $product->is_included_for_export_feed,
        ];

        // Filter the array to remove entries with null values
        $filteredData = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($filteredData);
    }
}
