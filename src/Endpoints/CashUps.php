<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Cashup;
use CCVShop\Api\Resources\CashupCollection;

class CashUps extends BaseEndpoint implements
    Get,
    GetAll
{
    protected string $resourcePath = 'cashups';

    /**
     * @description Get the resource object
     * @return Cashup;
     */
    protected function getResourceObject(): Cashup
    {
        return new Cashup($this->client);
    }

    /**
     * @description Get the resource collection object
     * @return CashupCollection
     */
    protected function getResourceCollectionObject(): CashupCollection
    {
        return new CashupCollection();
    }

    /**
     * @description Get one by id
     * @param int $id
     * @return Cashup
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): Cashup
    {
        /** @var Cashup $result */
        return $this->rest_getOne($id, []);
    }


    /**
     * @description Get all by parameters
     * @param array $parameters
     * @return CashupCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function getAll(array $parameters = []): CashupCollection
    {
        /** @var CashupCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
