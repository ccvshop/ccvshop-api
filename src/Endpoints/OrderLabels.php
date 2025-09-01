<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\GetFor;
use CCVShop\Api\Interfaces\Endpoints\PutFor;
use CCVShop\Api\Resources\Order;
use CCVShop\Api\Resources\OrderLabel;
use CCVShop\Api\Resources\OrderLabelCollection;

class OrderLabels extends BaseEndpoint implements GetFor, PutFor
{
    protected string $resourcePath = 'orderlabels';
    protected ?string $parentResourcePath = 'orders';

    /**
     * @return OrderLabel
     */
    protected function getResourceObject(): OrderLabel
    {
        return new OrderLabel($this->client);
    }

    /**
     * @return OrderLabelCollection
     */
    protected function getResourceCollectionObject(): OrderLabelCollection
    {
        return new OrderLabelCollection();
    }

    /**
     * @param int $id
     *
     * @return OrderLabel
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     *
     * @deprecated \CCVShop\Api\Endpoints\OrderLabels::getFor
     */
    public function get(int $id): OrderLabel
    {
        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $id));

        /**
         * @var OrderLabel $result
         */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    public function getFor(?Order $order = null): OrderLabelCollection
    {
        if ($order === null) {
            throw new \InvalidArgumentException('Order cannot be null');
        }
        $this->setParent(ResourceFactory::createParent($this->client->orders->getResourcePath(), $order->id));

        /**
         * @var OrderLabelCollection $result
         */
        $result = $this->restGetAll();

        return $result;
    }

    /**
     * @return void
     *
     * @deprecated use \CCVShop\Api\Endpoints\OrderLabels::putFor
     */
    public function put(): void
    {
        trigger_error('Use OrderLabels::putFor()', E_USER_ERROR);
    }

    /**
     * @return void
     *
     * @deprecated use \CCVShop\Api\Endpoints\OrderLabels::putFor
     */
    public function putOrderLabel(): void
    {
        trigger_error('Use OrderLabels::putFor()', E_USER_ERROR);
    }

    public function putFor(?Order $order = null, ?OrderLabelCollection $orderLabelCollection = null): void
    {
        if ($order === null) {
            throw new \InvalidArgumentException('Missing required parameter: Order');
        }
        if ($orderLabelCollection === null) {
            throw new \InvalidArgumentException('Missing required parameter: OrderLabelCollection');
        }

        $this->setParent(ResourceFactory::createParent($this->client->orders->getResourcePath(), $order->id));

        $this->restPut($orderLabelCollection);
    }
}
