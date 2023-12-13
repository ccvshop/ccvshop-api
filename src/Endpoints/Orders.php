<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\Order;
use CCVShop\Api\Resources\OrderCollection;

class Orders extends BaseEndpoint implements Get
{
    protected string $resourcePath = 'orders';

    /**
     * @return BaseResource
     */
    protected function getResourceObject(): Order
    {
        return new Order($this->client);
    }

    /**
     * @return BaseResourceCollection
     */
    protected function getResourceCollectionObject(): OrderCollection
    {
        return new OrderCollection();
    }

    /**
     * @description Get one by id
     * @param int $id
     * @return Order
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): Order
    {
        /** @var Order $result */
        $result = $this->rest_getOne($id, []);

        return $result;
    }
}
