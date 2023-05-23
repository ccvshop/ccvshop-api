<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\BaseResource;
use GuzzleHttp\Client;

class Merchant extends BaseResource
{
	public ?int $id = null;
	public ?string $href = null;
	public ?string $uuid = null;
	public ?string $gender = null;
	public ?string $first_name = null;
	public ?string $last_name = null;
	public ?string $full_name = null;
	public ?string $company = null;
	public ?string $email = null;
	public ?string $address_line = null;
	public ?string $street = null;
	public ?string $housenumber = null;
	public ?string $zipcode = null;
	public ?string $city = null;
	public ?string $country = null;
	public ?string $country_code = null;
	public ?string $telephone = null;
	public ?string $tax_number = null;
	public ?string $coc_number = null;

	public function getWebshops(): WebshopCollection
	{
		return $this->client->webshops->getFor($this);
	}
}
