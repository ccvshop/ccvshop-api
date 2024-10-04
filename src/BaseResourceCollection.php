<?php
declare(strict_types=1);

namespace CCVShop\Api;

abstract class BaseResourceCollection extends \ArrayObject
{
    public ?string $next = null;
    public ?string $previous = null;
}
