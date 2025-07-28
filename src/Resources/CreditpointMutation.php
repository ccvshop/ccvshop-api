<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\CreditpointMutations;
use stdClass;

class CreditpointMutation extends BaseResource
{
    //SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
    public ?string $href = null;
    public ?int $id = null;
    public ?int $amount = null;
    public ?string $create_date = null;
    public ?stdClass $parent = null;
    //SONAR_IGNORE_END

    public function getEndpoint(): CreditpointMutations
    {
        return $this->client->creditpointMutations;
    }
}
