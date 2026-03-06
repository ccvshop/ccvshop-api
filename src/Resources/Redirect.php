<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Redirects;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Redirect extends BaseResource implements PatchData, PostData
{
    // SONAR_IGNORE_START
    public ?int $id = null; // Unique id of the resource

    public ?string $href = null;
    public ?string $source_url = null; // Relative source
    public ?string $target_url = null; // Relative or absolute target_url
    public ?bool $active = null; // Is redirect active

    public ?object $parent = null; // Parent resource of this resource

    // SONAR_IGNORE_END

    public function getEndpoint(): Redirects
    {
        return $this->client->redirects;
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPatchData(): array
    {
        return $this->getPostData();
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPostData(): array
    {
        $data = [
            'source_url' => $this->source_url,
            'target_url' => $this->target_url,
            'active' => $this->active,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }
}
