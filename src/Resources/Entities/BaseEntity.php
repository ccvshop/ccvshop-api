<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources\Entities;

abstract class BaseEntity implements Entity
{
    /** @var array<string,string> */
    public static array $entities = [];
}
