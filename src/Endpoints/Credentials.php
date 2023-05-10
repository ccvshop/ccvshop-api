<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;

class Credentials extends BaseEndpoint
{
	protected string $resourcePath = 'credentials';
	protected ?string $parentResourcePath = 'webshops';

	protected function getResourceObject(): BaseResource
	{
		return new \CCVShop\Api\Resources\Credential($this->client);
	}

	public function get(int $credentialId): \CCVShop\Api\Resources\Credential
	{
		return $this->rest_getOne($credentialId, []);
	}

	public function getFor(\CCVShop\Api\Resources\Webshop $webshop, array $parameters = [])
	{
		return $this->getForId($webshop->id, $parameters);
	}

	public function getForId(int $webshopId, array $parameters = [])
	{
		$this->parentId = $webshopId;

		return $this->rest_getAll(null, $parameters);
	}

	public function postFor(\CCVShop\Api\Resources\Webshop $webshop, array $options)
	{
		return $this->postForId($webshop->id, $options);
	}

	public function postForId(int $webshopId, array $options)
	{
		$this->parentId = $webshopId;
		return $this->rest_post($options);
	}
}
