<?php

declare(strict_types=1);

namespace CCVShop\Api\Factory;

use CCVShop\Api\ApiCredentials;

class ApiCredentialFactory
{
    /**
     * @return ApiCredentials
     */
    public static function fromEnv(): ApiCredentials
    {
        // Loading .env file
        $dotenv = \Dotenv\Dotenv::createUnsafeImmutable(getcwd());
        $dotenv->load();

        return new ApiCredentials(
            getenv('CCVSHOP_API_HOSTNAME'),
            getenv('CCVSHOP_API_PUBLIC'),
            getenv('CCVSHOP_API_SECRET')
        );
    }

    /**
     * @param array<string,string> $config
     *
     * @return ApiCredentials
     */
    public static function fromArray(array $config): ApiCredentials
    {
        return new ApiCredentials(
            $config['hostname'],
            $config['public'],
            $config['secret']
        );
    }
}
