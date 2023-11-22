<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;

class OrdinanceReceipt extends BaseResource
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $ordinance_identifier = null;
    public ?string $type = null;
    public ?string $receipt_data = null;

    public function getEndpoint(): \CCVShop\Api\Endpoints\OrdinanceReceipts
    {
        return $this->client->ordinanceReceipts;
    }
}
