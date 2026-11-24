<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Resources\Brand;
use CCVShop\Api\Resources\BrandCollection;

class Brands extends BaseEndpoint
{
    protected string $resourcePath = 'brands';

    /**
     * @return Brand
     */
    public function getResourceObject(): Brand
    {
        return new Brand($this->client);
    }

    /**
     * @return BrandCollection
     */
    public function getResourceCollectionObject(): BrandCollection
    {
        return new BrandCollection();
    }

    /**
     * @param int $id
     *
     * @return Brand
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): Brand
    {
        /** @var Brand $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return BrandCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): BrandCollection
    {
        /** @var BrandCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
