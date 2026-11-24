<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Languages;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Language extends BaseResource implements PostData
{
    public ?string $label = null;
    public bool $active = false;
    public ?string $base_language = null;
    public ?string $iso_code = null;
    public ?string $flag_icon = null;
    public ?string $href = null;

    public function getEndpoint(): Languages
    {
        return $this->client->languages;
    }

    /**
     * @return array<string,string>
     */
    public function getPostData(): array
    {
        return [
            'label' => $this->label,
            'base_language' => $this->base_language,
            'flag_icon' => $this->flag_icon,
        ];
    }
}
