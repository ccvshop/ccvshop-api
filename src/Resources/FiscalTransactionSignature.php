<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\FiscalTransactionSignatures;

class FiscalTransactionSignature extends BaseResource
{
    public ?int $id = null;
    public ?string $href = null;
    public ?\DateTime $create_date = null;
    public ?string $signature_identifier = null;
    public ?string $type = null;
    public ?string $signature_data = null;

    public array $dates = ['create_date'];

    public function getEndpoint(): FiscalTransactionSignatures
    {
        return $this->client->fiscalTransactionSignatures;
    }
}
