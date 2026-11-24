<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class AppConfig extends BaseResource implements PostData, PatchData
{
    public ?int $id = null;
    public ?int $app_id = null;
    public ?string $type = null;
    public ?string $url = null;
    public ?string $name = null;
    public ?int $website_id = null;
    public ?string $jwt = null;

    /**
     * @return \CCVShop\Api\Endpoints\AppConfigs
     */
    public function getEndpoint(): \CCVShop\Api\Endpoints\AppConfigs
    {
        return $this->client->appConfigs;
    }

    /**
     * @return string[]
     */
    public function getPostData(): array
    {
        return [
            'type' => $this->type,
            'url' => $this->url,
            'name' => $this->name,
            'jwt' => $this->jwt,
        ];
    }

    /**
     * @return string[]
     */
    public function getPatchData(): array
    {
        return [
            'jwt' => $this->jwt,
        ];
    }
}
