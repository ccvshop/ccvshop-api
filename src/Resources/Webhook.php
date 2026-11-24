<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Webhooks;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Webhook extends BaseResource implements PostData, PatchData
{
    public ?int $id = null;
    public ?string $href = null;
    public ?\DateTime $createdate = null;
    public ?string $event = null;
    public ?string $address = null;
    public ?string $key = null;
    public ?bool $is_active = null;
    /** @var string[] */
    public array $dates = ['createdate'];

    public function getEndpoint(): Webhooks
    {
        return $this->client->webhooks;
    }

    /**
     * @return array<string,string|bool>
     */
    public function getPostData(): array
    {
        return [
            'event' => $this->event,
            'address' => $this->address,
            'is_active' => $this->is_active,
        ];
    }

    /**
     * @return array<string,string|bool>
     */
    public function getPatchData(): array
    {
        return [
            'address' => $this->address,
            'is_active' => $this->is_active,
        ];
    }
}
