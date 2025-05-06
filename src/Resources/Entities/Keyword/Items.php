<?php

namespace CCVShop\Api\Resources\Entities\Keyword;

use CCVShop\Api\Resources\Entities\BaseEntity;

class Items extends BaseEntity
{
    public ?string $keyword = null;
    public ?\stdClass $parent = null;
}
