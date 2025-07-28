<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\CreditPoints;
use DateTime;
use stdClass;

class Creditpoint extends BaseResource
{
	//SONAR_IGNORE_START
	// Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
	public ?string $href                 = null;
	public ?string $amount               = null;
	public ?string   $last_mutation_date = null;
	public ?stdClass $parent             = null;
	public ?stdClass $mutations          = null;
	//SONAR_IGNORE_END

	public function getEndpoint(): CreditPoints
	{
		return $this->client->creditPoints;
	}
}
