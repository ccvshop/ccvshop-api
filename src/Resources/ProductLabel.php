<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\ProductLabels;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class ProductLabel extends BaseResource
{
    // SONAR_IGNORE_START
    public ?string $href = null;
    public ?Entities\Label\Items $items = null;
    /** @var array<int, object>|null */
    public ?array $labels = null;
    public ?int $label_id = null;
    // SONAR_IGNORE_END

    public function getEndpoint(): ProductLabels
    {
        return $this->client->productLabels;
    }
}
