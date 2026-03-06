<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\FiscalTransactionSignatures;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class FiscalTransactionSignature extends BaseResource implements PostData, PatchData
{
    // SONAR_IGNORE_START
    public ?int $id = null;
    public ?string $href = null;
    public ?\DateTime $create_date = null;
    public ?string $signature_identifier = null;
    public ?string $type = null;
    public ?string $signature_data = null;
    // SONAR_IGNORE_END
    /** @var string[] */
    public array $dates = ['create_date'];

    public function getEndpoint(): FiscalTransactionSignatures
    {
        return $this->client->fiscalTransactionSignatures;
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPostData(): array
    {
        return [
            'create_date' => $this->create_date->format('Y-m-d\TH:i:s\Z'),
            'type' => $this->type,
            'signature_identifier' => $this->signature_identifier,
            'signature_data' => $this->signature_data,
        ];
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPatchData(): array
    {
        return [
            'signature_data' => $this->signature_data,
        ];
    }
}
