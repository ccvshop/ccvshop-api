<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Settings;
use CCVShop\Api\Interfaces\Resources\PutData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Setting extends BaseResource implements PutData
{
    // SONAR_IGNORE_START
    public ?bool $webshop_enabled = null;
    public ?string $webshop_disabled_title = null;
    public ?string $webshop_disabled_text = null;
    public ?string $currency = null;
    public ?float $default_vat_rat = null;
    public ?bool $prices_include_vat = null;
    public ?bool $full_ssl_webshop = null;
    public ?float $creditpoint_value = null;
    /** @var array<string|string>|null */
    public ?array $languages = null;
    public ?string $backend_language = null;
    public ?bool $separate_domain_per_language = null;
    public ?bool $stock = null;
    public ?string $ordering_without_stock = null;
    public ?\stdClass $stock_level_warnings = null;
    /** @var array<int|string>|null */
    public ?array $multishop_readonly_properties = null;
    /** @var array<int|string>|null */
    public ?array $checkout_type = null;
    public ?\stdClass $takeoutsettings = null;
    /** @var array<int|string>|null */
    public ?array $quotation_status = null;
    /** @var array<int|string>|null */
    public ?array $order_status = null;
    /** @var array<int|string>|null */
    public ?array $invoice_status = null;
    /** @var array<int|string>|null */
    public ?array $return_status = null;
    public ?\stdClass $parent = null;
    public ?string $href = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): Settings
    {
        return $this->client->settings;
    }

    /**
     * @return array<string,string|bool|string[]>
     */
    public function getPutData(): array
    {
        return [
            'languages' => $this->languages,
            'webshop_enabled' => $this->webshop_enabled,
            'webshop_disabled_title' => $this->webshop_disabled_title,
            'webshop_disabled_text' => $this->webshop_disabled_text,
        ];
    }
}
