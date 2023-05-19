<?php

namespace CCVShop\Api;

use Carbon\Carbon;
use GuzzleHttp\Client;

abstract class BaseEndpoint
{
	protected ApiClient $client;
	protected ?int $parentId = null;
	protected ?string $parentResourcePath = null;
	protected string $resourcePath;

	abstract protected function getResourceObject(): BaseResource;

	public function __construct(ApiClient $api)
	{
		$this->client = $api;
	}

	protected function rest_getOne(int $id, array $filters): BaseResource
	{
		$apiPrefix = '/api/rest/v1/';
		$client    = new Client([
			'base_uri' => $this->client->apiCredentials->GetApiHostName(),
		]);

		$uri        = $apiPrefix . $this->getResourcePath() . '/' . $id;
		$xDate      = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->client->apiCredentials->GetApiPublic(),
			'GET',
			$uri,
			'',
			$xDate,

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->client->apiCredentials->GetApiSecret());

		try {
			$res = $client->request('GET', $uri,
				[
					'headers' => [
						'x-public' => $this->client->apiCredentials->GetApiPublic(),
						'x-hash' => $xHash,
						'x-date' => $xDate,
					],

				]
			);
		} catch (\GuzzleHttp\Exception\ServerException $e) {
			throw  \CCVShop\Api\Factory\ExceptionFactory::createFromApiResult($e->getResponse()->getBody());
		}

		$this->validateResponse($res, $uri, 'GET');

		return Factory\ResourceFactory::createFromApiResult(json_decode($res->getBody(), false, 512, JSON_THROW_ON_ERROR), $this->getResourceObject());
	}

	protected function rest_getAll($from = null, $limit = null, array $filters = [])
	{
		$apiPrefix = '/api/rest/v1/';
		$client    = new Client([
			'base_uri' => $this->client->apiCredentials->GetApiHostName(),
		]);

		$uri        = $apiPrefix . $this->getResourcePath() . $this->filtersToQuery($filters);
		$xDate      = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->client->apiCredentials->GetApiPublic(),
			'GET',
			$uri,
			'',
			$xDate,

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->client->apiCredentials->GetApiSecret());

		$res = $client->request('GET', $uri,
			[
				'headers' => [
					'x-public' => $this->client->apiCredentials->GetApiPublic(),
					'x-hash' => $xHash,
					'x-date' => $xDate,
				],

			]
		);
		$this->validateResponse($res, $uri, 'GET');

		$collection = $this->getResourceCollectionObject();

		$json = json_decode($res->getBody());

		if (!isset($json->items)) {
			$collection[] = Factory\ResourceFactory::createFromApiResult($json, $this->getResourceObject());;
		} else {
			foreach ($json->items as $item) {
				$collection[] = Factory\ResourceFactory::createFromApiResult($item, $this->getResourceObject());;
			}
		}

		return $collection;
	}

	protected function rest_post(array $data): BaseResource
	{
		$apiPrefix = '/api/rest/v1/';
		$client    = new Client([
			'base_uri' => $this->client->apiCredentials->GetApiHostName(),
		]);

		$uri        = $apiPrefix . $this->getResourcePath();
		$xDate      = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->client->apiCredentials->GetApiPublic(),
			'POST',
			$uri,
			json_encode($data, JSON_THROW_ON_ERROR),
			$xDate,

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->client->apiCredentials->GetApiSecret());

		$res = $client->post($uri,
			[
				'headers' => [
					'x-public' => $this->client->apiCredentials->GetApiPublic(),
					'x-hash' => $xHash,
					'x-date' => $xDate,
				],
				'json' => $data,

			]
		);

		$this->validateResponse($res, $uri, 'POST');

		return Factory\ResourceFactory::createFromApiResult(json_decode($res->getBody(), false, 512, JSON_THROW_ON_ERROR), $this->getResourceObject());
	}

	protected function rest_patch(int $id, array $data): void
	{
		$apiPrefix = '/api/rest/v1/';
		$client    = new Client([
			'base_uri' => $this->client->apiCredentials->GetApiHostName(),
		]);

		$uri        = $apiPrefix . $this->getResourcePath() . '/' . $id;
		$xDate      = Carbon::Now('utc')->format('c');
		$dataToHash = [
			$this->client->apiCredentials->GetApiPublic(),
			'PATCH',
			$uri,
			json_encode($data, JSON_THROW_ON_ERROR),
			$xDate,

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->client->apiCredentials->GetApiSecret());

		$res = $client->patch($uri,
			[
				'headers' => [
					'x-public' => $this->client->apiCredentials->GetApiPublic(),
					'x-hash' => $xHash,
					'x-date' => $xDate,
				],
				'json' => $data,

			]
		);

		$this->validateResponse($res, $uri, 'PATCH');

		return;
	}

	public function getResourcePath()
	{
		if (!empty($this->parentId) && $this->parentResourcePath !== null) {
			return sprintf('%s/%s/%s', $this->parentResourcePath, $this->parentId, $this->resourcePath);
		}

		return $this->resourcePath;
	}

	protected function validateResponse(\GuzzleHttp\Psr7\Response $res, string $uri, string $method): void
	{
		$dataToHash = [
			$this->client->apiCredentials->GetApiPublic(),
			$method,
			$uri,
			$res->getBody(),
			$res->getHeader('x-date')[0],

		];

		$xHash = hash_hmac('sha512', implode('|', $dataToHash), $this->client->apiCredentials->GetApiSecret());

		if ($xHash !== $res->getHeader('x-hash')[0]) {
			throw new \Exception('Result hash not equal');
		}
	}

	protected function filtersToQuery(array $filters = []): string
	{
		if (empty($filters)) {
			return '';
		}

		return '?' . http_build_query($filters);
	}
}
