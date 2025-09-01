<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Order;
use CCVShop\Api\Resources\OrderCollection;

class Orders extends BaseEndpoint implements Get, GetAll
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
     *
     * @param int $id
     *
     * @return Order
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): Order
    {
        /** @var Order $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    public function getAll(array $parameters = []): OrderCollection
    {
        /** @var OrderCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
