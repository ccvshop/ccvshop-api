<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;

class FiscalTransactionSignature extends BaseResource
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $create_date = null;
    public ?string $signature_identifier = null;
    public ?string $type = null;
    public ?string $signature_data = null;

    public function getEndpoint(): \CCVShop\Api\Endpoints\FiscalTransactionSignature
    {
        return $this->client->fiscalTransactionSignature;
    }
}
