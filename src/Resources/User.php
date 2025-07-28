<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use stdClass;

class User extends BaseResource
{
	//SONAR_IGNORE_START
	// Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden ....
	public ?int $id = null;
    public ?string $href = null;
    public ?string $username = null;
    public ?int $group_id = null;
    public ?bool $status = null;
    public ?string $approval_status = null;
    public ?string $product_in_category_discount = null;
    public ?stdClass $userinfo = null;
	//SONAR_IGNORE_END


    public function getEndpoint(): \CCVShop\Api\Endpoints\Users
    {
        return $this->client->users;
    }
}
