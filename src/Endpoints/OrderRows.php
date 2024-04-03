<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\Order;
use CCVShop\Api\Resources\OrderRow;
use CCVShop\Api\Resources\OrderRowCollection;

class OrderRows extends BaseEndpoint implements Get
{
    protected string $resourcePath = 'orderrows';
    protected ?string $parentResourcePath = 'orders';

    /**
     * @return OrderRow
     */
    protected function getResourceObject(): OrderRow
    {
       return new OrderRow($this->client);
    }

    /**
     * @return OrderRowCollection
     */
    protected function getResourceCollectionObject(): OrderRowCollection
    {
        return new OrderRowCollection();
    }

    /**
     * @description Get one by id
     * @param int $id
     * @return OrderRow
     * @throws \CCVShop\Api\Exceptions\InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): OrderRow
    {
        /** @var OrderRow $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @description Get all order rows by order resource.
     * @param Order $order
     * @param array $parameters
     * @return OrderRowCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getFor(Order $order, array $parameters = []): OrderRowCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($order));
        /** @var OrderRowCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
