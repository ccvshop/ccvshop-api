<?php

namespace CCVShop\Api\Endpoints;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\ApiCredentials;
use CCVShop\Api\BaseCollection;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Resources\Call\GetAll;
use CCVShop\Api\Resources\Call\GetOne;
use CCVShop\Api\Resources\Credential;
use CCVShop\Api\Resources\Merchant;
use CCVShop\Api\Resources\WebshopCollection;
use GuzzleHttp\Client;

class Webshops extends BaseEndpoint
{
	protected string $resourcePath = 'webshops';
	protected ?string $parentResourcePath = 'merchant';

	protected function getResourceObject(): BaseResource
	{
		return new \CCVShop\Api\Resources\Webshop($this->client);
	}

	protected function getResourceCollectionObject(): BaseCollection
	{
		return new WebshopCollection();
	}

	public function get(int $webshopId): \CCVShop\Api\Resources\Webshop
	{
		return $this->rest_getOne($webshopId, []);
	}

	public function getFor(\CCVShop\Api\Resources\Merchant $merchant, array $parameters = [])
	{
		return $this->getForId($merchant->id, $parameters);
	}

	public function getForId(int $merchantId, array $parameters = [])
	{
		$this->parentId = $merchantId;

		return $this->rest_getAll(null, null, $parameters);
	}

	public function getCredentialsById(int $webshopId): \CCVShop\Api\Resources\Credential
	{
		return $this->client->credentials->getForId($webshopId);
	}

	public function getMerchantsById(int $webshopId): \CCVShop\Api\Resources\MerchantCollection
	{
		return $this->client->merchant->getForId($webshopId);
	}

	public function getAll(array $parameters)
	{
		return $this->rest_getAll(null, null, $parameters);
	}
}
