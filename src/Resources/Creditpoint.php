<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\CreditPoints;
use CCVShop\Api\Interfaces\Resources\PutData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Creditpoint extends BaseResource implements PutData
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
    public ?string $href = null;
    public ?int $amount = null;
    public ?string $last_mutation_date = null;
    public ?\stdClass $parent = null;
    public ?\stdClass $mutations = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): CreditPoints
    {
        return $this->client->creditPoints;
    }

    /**
     * @return int[]
     */
    public function getPutData(): array
    {
        return [$this->amount];
    }
}
