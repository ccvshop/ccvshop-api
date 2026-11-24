<?php

declare(strict_types=1);

namespace CCVShop\Api\Factory;

use CCVShop\Api\ApiClient;
use CCVShop\Api\ApiCredentials;

class ApiClientFactory
{
    /**
     * @param ApiCredentials                   $credential
     * @param \GuzzleHttp\ClientInterface|null $httpClient
     *
     * @return ApiClient
     */
    public static function create(ApiCredentials $credential, ?\GuzzleHttp\ClientInterface $httpClient = null): ApiClient
    {
        return new ApiClient($credential->getHostName(), $credential->getPublic(), $credential->getSecret(), $httpClient);
    }
}
