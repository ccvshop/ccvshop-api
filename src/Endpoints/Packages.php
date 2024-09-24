<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Package;
use CCVShop\Api\Resources\PackageCollection;
use JsonException;

class Packages extends BaseEndpoint implements
    Get,
    GetAll
{
    protected string $resourcePath = 'packages';

    /**
     * @return Package()
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
     * @return Package
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function get(int $id): Package
    {
        /** @var Package $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return PackageCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function getAll(array $parameters = []): PackageCollection
    {
        /** @var PackageCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }


}
