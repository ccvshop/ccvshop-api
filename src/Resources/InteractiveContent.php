<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;

class InteractiveContent extends BaseResource
{

    public ?ViewCollection $views = null;
    public array $elementObjects = ['views' => \CCVShop\Api\Resources\ViewCollection::class];

    public function getEndpoint(): BaseEndpoint
    {
        // TODO: Implement getEndpoint() method.
    }
}
