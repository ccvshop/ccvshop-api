<?php
declare(strict_types=1);

namespace CCVShop\Api;

use CCVShop\Api\Resources\Merchant;

class ApiClient
{
	public \CCVShop\Api\ApiCredentials $apiCredentials;
	public \CCVShop\Api\Endpoints\Credentials $credentials;
	public \CCVShop\Api\Endpoints\Merchant $merchant;
	public \CCVShop\Api\Endpoints\Webshops $webshops;

	public function __construct(?string $hostName = null, ?string $apiPublic = null, ?string $apiSecret = null)
	{
		$this->apiCredentials = new \CCVShop\Api\ApiCredentials(
			$hostName ?? $_ENV['CCVSHOP_API_HOSTNAME'],
			$apiPublic ?? $_ENV['CCVSHOP_API_PUBLIC'],
			$apiSecret ?? $_ENV['CCVSHOP_API_SECRET']
		);

		$this->credentials = new \CCVShop\Api\Endpoints\Credentials($this);
		$this->merchant    = new \CCVShop\Api\Endpoints\Merchant($this);
		$this->webshops    = new \CCVShop\Api\Endpoints\Webshops($this);
	}
}
