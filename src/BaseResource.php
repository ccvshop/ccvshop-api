<?php

namespace CCVShop\Api;

abstract class BaseResource
{
	protected ApiClient $client;

	/**
	 * @param ApiClient $client
	 */
	public function __construct(ApiClient $client)
	{
		$this->client = $client;
	}

}
