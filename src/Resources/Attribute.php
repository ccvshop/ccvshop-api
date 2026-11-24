<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Attributes;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Attribute extends BaseResource
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $name = null;
    public ?string $type = null;

    /**
     * @return Attributes
     */
    public function getEndpoint(): Attributes
    {
        return $this->client->attributes;
    }
}
