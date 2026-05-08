<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Invoices;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Invoice extends BaseResource
{
    // SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $id = null;
    public ?string $invoicenumber_prefix = null;
    public ?int $invoicenumber = null;
    public ?string $invoicenumber_full = null;
    public ?string $ordernumber_prefix = null;
    public ?int $ordernumber = null;
    public ?string $ordernumber_full = null;
    public ?\DateTime $create_date = null;
    public ?string $status = null;
    public ?string $status_name = null;
    public ?string $type = null;
    public ?string $payment_link_sent = null;
    public ?bool $taxes_included = null;
    public ?bool $invoice_row_taxes_included = null;
    public ?bool $is_intra_community_order = null;
    public ?bool $shipping_taxes_included = null;
    /** @deprecated */
    public ?float $shipping_tax_percentage = null;
    /** @var array<int,int>|null */
    public ?array $shipping_tax_percentages = null;
    public ?float $total_shipping = null;
    public ?float $total_discounts = null;
    public ?float $total_price_inc_tax = null;
    public ?float $total_price_exc_tax = null;
    public ?float $total_price = null;
    public ?float $total_tax = null;
    public ?string $currency = null;
    public ?string $extra_payment_option = null;
    public ?float $extra_payment_option_price = null;
    public ?float $paymethod_costs = null;
    public ?float $credit_point_discount = null;
    public ?float $extra_costs = null;
    public ?string $extra_costs_description = null;
    public ?string $external_reference = null;
    public ?string $deeplink = null;
    public ?\stdClass $user = null;
    public ?\stdClass $customer = null;
    public ?\stdClass $discountcoupon = null;
    public ?int $minimum_age = null;
    public ?Order $order = null;
    public ?\stdClass $invoicerows = null;
    public ?\stdClass $invoicenotifications = null;
    // SONAR_IGNORE_END

    public array $dates = ['create_date'];

    /**
     * @return Invoices
     */
    public function getEndpoint(): Invoices
    {
        return $this->client->invoices;
    }
}
