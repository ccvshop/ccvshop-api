<?php
declare(strict_types=1);

namespace CCVShop\Api;

use CCVShop\Api\Resource\Webshops;
use CCVShop\Api\Resource\Credentials;

class Api
{
	private static $instance;
	public Webshops $webshops;
	public \CCVShop\Api\Resource\Credentials $credentials;

	public static function Call()
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	final private function __construct()
	{
		$credentials = new \CCVShop\Api\Credentials($_ENV['CCVSHOP_API_HOSTNAME'], $_ENV['CCVSHOP_API_PUBLIC'], $_ENV['CCVSHOP_API_SECRET']);

		$this->credentials = new Credentials($credentials);
		$this->webshops    = new Webshops($credentials);
	}
}
