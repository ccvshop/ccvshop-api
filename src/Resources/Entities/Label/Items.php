<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources\Entities\Label;

use CCVShop\Api\Resources\Entities\BaseEntity;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Items extends BaseEntity
{
    public ?int $label_id = null;
    public ?string $parent = null;
}
