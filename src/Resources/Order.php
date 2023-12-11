<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseResource;

class Order extends BaseResource
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $ordernumber_prefix = null;
    public ?int $ordernumber = null;
    public ?string $ordernumber_full = null;
    public ?int $invoicenumber = null;
    public ?string $transaction_id = null;
    public ?\DateTime $create_date = null;
    public ?string $deliver_method = null;
    public ?string $deliver_date = null;
    public ?\stdClass $take_out_window = null;
    public ?bool $is_platform_sale = null;
    public ?string $orderedinlng = null;
    public ?int $status = null;
    public ?bool $is_completed = null;
    public ?string $basket_href = null;
    public ?string $checkout_href = null;
    public ?bool $paid = null;
    public ?bool $safety_deposit_returned = null;
    public ?int $paymethod_id = null;
    public ?string $paymethod = null;
    public ?string $paymethod_label = null;
    public ?bool $taxes_included = null;
    public ?bool $order_row_taxes_included = null;
    public ?bool $shipping_taxes_included = null;
    public ?float $shipping_tax_percentage = null;
    public ?bool $is_intra_community_order = null;
    public ?float $total_orderrow_price = null;
    public ?float $total_shipping = null;
    public ?float $total_discounts = null;
    public ?float $total_price = null;
    public ?string $currency = null;
    public ?float $total_tax = null;
    public ?float $total_weight = null;
    public ?string $extra_payment_option = null;
    public ?float $extra_payment_option_price = null;
    public ?bool $extra_payment_option_no_sentprice = null;
    public ?bool $extra_payment_option_pay_on_pickup = null;
    public ?float $extra_price = null;
    public ?float $paymethod_costs = null;
    public ?float $credit_point_discount = null;
    public ?float $extra_costs = null;
    public ?string $extra_costs_description = null;
    public ?string $track_and_trace_code = null;
    public ?string $track_and_trace_carrier = null;
    public ?string $track_and_trace_deeplink = null;
    public ?string $reservationnumber = null;
    public ?string $delivery_option = null;

    public ?\stdClass $user = null;

    public ?\stdClass $discountcoupon = null;

    public ?\stdClass $customer = null;

    public ?\stdClass $pickup_address = null;
    public ?string $packing_slip_deeplink = null;

    public ?\stdClass $orderrows = null;

    public ?\stdClass $ordernotes = null;

    public ?\stdClass $ordermessages = null;

    public ?\stdClass $ordernotifications = null;

    public ?\stdClass $orderaffiliatenetworks = null;

    public ?\stdClass $orderlabels = null;

    public ?\stdClass $terminalreceipts = null;

    public ?\stdClass $fiscaltransactionsignatures = null;

    public ?\stdClass $invoices = null;

    protected array $dates = ['create_date'];

    /**
     * @return \CCVShop\Api\Endpoints\Orders
     */
    public function getEndpoint(): \CCVShop\Api\Endpoints\Orders
    {
        return $this->client->orders;
    }

    /**
     * @description Retrieve the fiscal transaction signatures of the current order.
     * @return FiscalTransactionSignatureCollection
     * @throws \CCVShop\Api\Exceptions\InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getFiscalTransactionSignatures(): FiscalTransactionSignatureCollection
    {
        return $this->client->fiscalTransactionSignatures->getFor($this);
    }

    /**
     * @description Retrieve the order rows of the current order.
     * @return OrderRowCollection
     * @throws \CCVShop\Api\Exceptions\InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getOrderRows(): OrderRowCollection
    {
        return $this->client->orderrows->getFor($this);
    }
}
