<?php

namespace CCVShop\Api\Resource;

use Carbon\Carbon;
use CCVShop\Api\Resource\Call\Post;
use GuzzleHttp\Client;

class Credentials implements Post
{
	public function __construct(\CCVShop\Api\Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function Post(int $parentId, array $data)
	{
		$client = new Client([
			'base_uri' => $this->credentials->GetApiHostName(),
		]);

		$uri = sprintf('/api/rest/v1/webshops/%s/credentials', $parentId);

		$xDate = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->credentials->GetApiPublic(),
			'POST',
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
			'POST',
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
