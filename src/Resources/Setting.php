<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Settings;

class Setting extends BaseResource
{
    public ?bool $webshop_enabled = null;
    public ?string $webshop_disabled_title = null;
    public ?string $webshop_disabled_text = null;
    public ?string $currency = null;
    public ?float $default_vat_rat = null;
    public ?bool $prices_include_vat = null;
    public ?bool $full_ssl_webshop = null;
    public ?float $creditpoint_value = null;
    public ?array $languages = null;
    public ?string $backend_language = null;
    public ?bool $separate_domain_per_language = null;
    public ?bool $stock = null;
    public ?string $ordering_without_stock = null;
    public ?\stdClass $stock_level_warnings = null;
    public ?array $multishop_readonly_properties = null;
    public ?array $checkout_type = null;
    public ?\stdClass $takeoutsettings = null;
    public ?array $quotation_status = null;
    public ?array $order_status = null;
    public ?array $invoice_status = null;
    public ?array $return_status = null;
    public ?\stdClass $parent = null;
    public ?string $href = null;

    public function getEndpoint(): Settings
    {
        return $this->client->settings;
    }
}
