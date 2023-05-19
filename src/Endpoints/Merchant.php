<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseEndpoint;

class Merchant extends BaseEndpoint
{
	protected string $resourcePath = 'merchant';
	protected ?string $parentResourcePath = 'webshops';

	protected function getResourceObject(): BaseResource
	{
		return new \CCVShop\Api\Resources\Merchant($this->client);
	}

	protected function getResourceCollectionObject()
	{
		return new \CCVShop\Api\Resources\MerchantCollection();
	}

	public function get(int $merchantId): \CCVShop\Api\Resources\Merchant
	{
		return $this->rest_getOne($merchantId, []);
	}

	public function getFor(\CCVShop\Api\Resources\Webshop $webshop, array $parameters = [])
	{
		return $this->getForId($webshop->id, $parameters);
	}

	public function getForId(int $webshopId, array $parameters = [])
	{
		$this->parentId = $webshopId;

		return $this->rest_getAll(null, null, $parameters);
	}

	public function patch(\CCVShop\Api\Resources\Merchant $merchant)
	{
		$this->parentId = null;

		return $this->rest_patch($merchant->id, [
			'uuid' => $merchant->uuid,
		]);
	}

	public function getAll(array $parameters)
	{
		return $this->rest_getAll(null, null, $parameters);
	}
}
