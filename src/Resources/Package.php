<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Packages;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Package extends BaseResource
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, noodzakelijk om de representatie van de API gelijk te houden.
    public ?string $href = null;
    public ?int $id = null;
    public ?string $name = null;
    public ?\stdClass $parent = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): Packages
    {
        return $this->client->packages;
    }
}
