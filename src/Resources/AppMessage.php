<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class AppMessage extends BaseResource implements PostData
{
    public ?int $id = null;
    public ?int $app_id = null;
    public ?int $website_id = null;
    public ?string $type = null;
    public ?bool $read = null;
    public ?string $icon = null;
    public ?string $message = null;
    public ?string $level = null;

    /**
     * @return \CCVShop\Api\Endpoints\AppMessages
     */
    public function getEndpoint(): \CCVShop\Api\Endpoints\AppMessages
    {
        return $this->client->appMessages;
    }

    /**
     * @return array<string,string>
     */
    public function getPostData(): array
    {
        $data = [
            'type' => $this->type,
            'message' => $this->message,
            'level' => $this->level,
        ];

        if (! empty($this->icon)) {
            $data['icon'] = $this->icon;
        }

        return $data;
    }
}
