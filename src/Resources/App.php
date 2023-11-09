<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Apps;

class App extends BaseResource
{
    //SONAR_IGNORE_START
    public ?int $id = null;
    public ?string $href = null;
    public ?string $name = null;
    public ?\stdClass $eur_prices = null;
    public ?\stdClass $chf_prices = null;
    public ?string $create_date = null;
    public ?string $modified_date = null;
    public ?string $description = null;
    public ?string $cover = null;
    public ?string $logo = null;
    public ?\stdClass $developer = null;
    public ?int $number_of_installations = null;
    public ?bool $is_installed = null;
    public ?array $available_languages = null;
    public ?array $photos = null;
    public ?\stdClass $categories = null;
    public ?\stdClass $code_blocks = null;
    public ?\stdClass $psp = null;

    public function getEndpoint(): Apps
    {
        return $this->client->apps;
    }
}
