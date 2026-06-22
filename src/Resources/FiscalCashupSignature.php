<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\FiscalCashupSignatures;
use CCVShop\Api\Interfaces\Resources\PatchData;

class FiscalCashupSignature extends BaseResource implements PatchData
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $status = null;
    public ?string $fiskalyCashPointClosingId = null;

    /**
     * @return FiscalCashupSignatures
     */
    public function getEndpoint(): FiscalCashupSignatures
    {
        return $this->client->fiscalCashupSignatures;
    }

    /**
     * @return array|mixed[]
     */
    public function getPatchData(): array
    {
        $data = [];

        if ($this->status !== null) {
            $data['status'] = $this->status;
        }

        if ($this->fiskalyCashPointClosingId !== null) {
            $data['fiskaly_cash_point_closing_id'] = $this->fiskalyCashPointClosingId;
        }

        return $data;
    }
}
