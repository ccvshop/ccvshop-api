<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Package;
use CCVShop\Api\Resources\PackageCollection;

class Packages extends BaseEndpoint implements Get, GetAll
{
    protected string $resourcePath = 'packages';

    /**
     * @return Package
     */
    protected function getResourceObject(): Package
    {
        return new Package($this->client);
    }

    /**
     * @return PackageCollection
     */
    protected function getResourceCollectionObject(): PackageCollection
    {
        return new PackageCollection();
    }

    /**
     * @param int $id
     *
     * @return Package
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): Package
    {
        /** @var Package $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return PackageCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): PackageCollection
    {
        /** @var PackageCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
