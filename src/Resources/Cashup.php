<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\CashUps;
use DateTime;

class Cashup extends BaseResource
{
    public ?int      $id           = null;
    public ?string   $href         = null;
    public ?string   $number_full  = null;
    public ?DateTime $create_date  = null;
    public ?DateTime $start_period = null;
    public ?DateTime $end_period   = null;
    public ?string   $status       = null;
    public array     $balances     = [];
    public array      $vat_totals   = [];

    public array $dates = ['create_date', 'start_period', 'end_period'];

    public function getEndpoint(): CashUps
    {
        return $this->client->cashUps;
    }
}
