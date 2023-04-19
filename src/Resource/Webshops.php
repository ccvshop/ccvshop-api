<?php

namespace CCVShop\Api\Resource;

use Carbon\Carbon;
use CCVShop\Api\Credentials;
use CCVShop\Api\Resource\Call\GetAll;
use CCVShop\Api\Resource\Call\GetOne;
use GuzzleHttp\Client;

class Webshops implements GetAll, GetOne
{
	private Credentials $credentials;

	/**
	 * @param Credentials $credentials
	 */
	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function getAll()
	{
		$client = new Client([
			'base_uri' => $this->credentials->GetApiHostName() . '/api/rest/v1/',
		]);

		$uri = '/api/rest/v1/webshops';

		$xDate      = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->credentials->GetApiPublic(),
			'GET',
			$uri,
			'',
			$xDate,

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->credentials->GetApiSecret());

		$res = $client->request('GET', 'webshops',
			[
				'headers' => [
					'x-public' => $this->credentials->GetApiPublic(),
					'x-hash' => $xHash,
					'x-date' => $xDate,
				],

			]
		);
		$this->validateResponse($res, $uri);

		return \CCVShop\Api\Entity\Collection\Webshops::createFromJson($res->getBody());
	}

	public function getOne(int $resourceId)
	{
		$client = new Client([
			'base_uri' => $this->credentials->GetApiHostName() . '/api/rest/v1/',
		]);

		$uri = '/api/rest/v1/webshops/' . $resourceId;

		$xDate      = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->credentials->GetApiPublic(),
			'GET',
			$uri,
			'',
			$xDate,

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->credentials->GetApiSecret());

		$res = $client->request('GET', 'webshops/' . $resourceId,
			[
				'headers' => [
					'x-public' => $this->credentials->GetApiPublic(),
					'x-hash' => $xHash,
					'x-date' => $xDate,
				],

			]
		);
		$this->validateResponse($res, $uri);

		return \CCVShop\Api\Entity\Resource\Webshops::createFromJson($res->getBody());
	}

	protected function validateResponse(\GuzzleHttp\Psr7\Response $res, string $uri): void
	{
		$dataToHash = [
			$this->credentials->GetApiPublic(),
			'GET',
			$uri,
			$res->getBody(),
			$res->getHeader('x-date')[0],

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->credentials->GetApiSecret());

		if ($xHash !== $res->getHeader('x-hash')[0]) {
			throw new \Exception('Result hash not equal');
		}
	}
}
