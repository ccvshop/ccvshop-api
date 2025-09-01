<?php

declare(strict_types=1);

namespace CCVShop\Api;

/**
 * @extends \ArrayObject<int, BaseResource>
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class BaseResourceCollection extends \ArrayObject
{
    public ?string $next = null;
    public ?string $previous = null;
}
