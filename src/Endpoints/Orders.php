<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\Order;
use CCVShop\Api\Resources\OrderCollection;
use JsonException;
use ReflectionException;

class Orders extends BaseEndpoint implements Get
{
    protected string $resourcePath = 'orders';

    /**
     * @return Order
     */
    protected function getResourceObject(): Order
    {
        return new Order($this->client);
    }

    /**
     * @return OrderCollection
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
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): Order
    {
        /** @var Order $result */
        return $this->rest_getOne($id, []);
    }
}
