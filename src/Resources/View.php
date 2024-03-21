<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Apps;

class View extends BaseResource
{
    public ?string $name = null;
    public ?string $endpoint = null;
    public ?ElementCollection $elements = null;

    public array $elementObjects = ['elements' => \CCVShop\Api\Resources\ElementCollection::class];

    public function getEndpoint(): Apps
    {
        // TODO:: dit moet eigenlijk nog ->view erbij hebben.
        return $this->client->appCodeBlocks->interactive_content;
    }
}
