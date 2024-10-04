<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Languages;

class Language extends BaseResource
{
    public ?string $label = null;
    public bool $active = false;
    public ?string $base_language  = null;
    public ?string $iso_code = null;
    public ?string $flag_icon = null;
    public ?string $href = null;

    public function getEndpoint(): Languages
    {
        return $this->client->languages;
    }
}
