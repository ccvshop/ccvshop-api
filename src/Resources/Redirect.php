<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Redirects;

class Redirect extends BaseResource
{
    //SONAR_IGNORE_START
    public ?int $id = null; // Unique id of the resource

    public ?string $href = null;
    public ?string $source_url = null; // Relative source
    public ?string $target_url = null; // Relative or absolute target_url
    public ?bool $active = null; // Is redirect active

    public ?object $parent = null; // Parent resource of this resource
    //SONAR_IGNORE_END


    public function getEndpoint(): Redirects
    {
        return $this->client->redirects;
    }
}
