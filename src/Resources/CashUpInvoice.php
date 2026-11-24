<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\CashUpInvoices;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class CashUpInvoice extends BaseResource
{
    // SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $cashup_id = null;
    public ?int $order_invoice_id = null;
    public ?\stdClass $order_invoice = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): CashUpInvoices
    {
        return $this->client->cashUpInvoices;
    }
}
