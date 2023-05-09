<?php

namespace CCVShop\Api\Resource;

use Carbon\Carbon;
use CCVShop\Api\Credentials;
use CCVShop\Api\Resource\Call\Patch;
use GuzzleHttp\Client;

class Merchant implements Patch
{
	private Credentials $credentials;

	/**
	 * @param Credentials $credentials
	 */
	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function Patch(int $resourceId, array $data)
	{
		$client = new Client([
			'base_uri' => $this->credentials->GetApiHostName(),
		]);

		$uri = sprintf('/api/rest/v1/merchant/%s', $resourceId);

		$xDate = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->credentials->GetApiPublic(),
			'PATCH',
			$uri,
			json_encode($data, JSON_THROW_ON_ERROR),
			$xDate,

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->credentials->GetApiSecret());

		$res = $client->request('POST', $uri,
			[
				'headers' => [
					'x-public' => $this->credentials->GetApiPublic(),
					'x-hash' => $xHash,
					'x-date' => $xDate,
				],
				'json' => $data,

			]
		);
		$this->validateResponse($res, $uri);

		return \CCVShop\Api\Entity\Resource\Credentials::createFromJson($res->getBody());
	}

	protected function validateResponse(\GuzzleHttp\Psr7\Response $res, string $uri): void
	{
		$dataToHash = [
			$this->credentials->GetApiPublic(),
			'PATCH',
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
