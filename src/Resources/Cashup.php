<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\CashUps;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Cashup extends BaseResource
{
    // SONAR_IGNORE_START
    public ?int $id = null;
    public ?string $href = null;
    public ?string $number_full = null;
    public ?\DateTime $create_date = null;
    public ?\DateTime $start_period = null;
    public ?\DateTime $end_period = null;
    public ?string $status = null;
    /** @var array<int,object> */
    public array $balances = [];
    /** @var array<int,object> */
    public array $vat_totals = [];
    // SONAR_IGNORE_END
    /** @var string[] */
    public array $dates = ['create_date', 'start_period', 'end_period'];

    public function getEndpoint(): CashUps
    {
        return $this->client->cashUps;
    }
}
