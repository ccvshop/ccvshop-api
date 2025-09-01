<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Cashup;
use CCVShop\Api\Resources\CashupCollection;
use GuzzleHttp\Exception\GuzzleException;

class CashUps extends BaseEndpoint implements Get, GetAll
{
    protected string $resourcePath = 'cashups';

    /**
     * @description Get the resource object
     *
     * @return Cashup
     */
    protected function getResourceObject(): Cashup
    {
        return new Cashup($this->client);
    }

    /**
     * @description Get the resource collection object
     *
     * @return CashupCollection
     */
    protected function getResourceCollectionObject(): CashupCollection
    {
        return new CashupCollection();
    }

    /**
     * @description Get one by id
     *
     * @param int $id
     *
     * @return Cashup
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): Cashup
    {
        /** @var Cashup $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @description Get all by parameters
     *
     * @param array<string,int|float|string> $parameters
     *
     * @return CashupCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): CashupCollection
    {
        /** @var CashupCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
