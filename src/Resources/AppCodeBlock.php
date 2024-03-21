<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\AppCodeBlocks;
use CCVShop\Api\Endpoints\Apps;

class AppCodeBlock extends BaseResource
{
    public ?string $href = null;
    public ?int $id = null;
    public ?int $app_id = null;
    public ?string $placeholder = null;
    public ?string $title = null;
    public ?string $value = null;
    public ?InteractiveContent $interactive_content = null;

    public array $elementObjects = ['interactive_content' => \CCVShop\Api\Resources\InteractiveContent::class];

    /**
     * @return AppCodeBlocks
     */
    public function getEndpoint(): AppCodeBlocks
    {
        return $this->client->appCodeBlocks;
    }
}
