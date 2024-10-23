<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Put;
use CCVShop\Api\Resources\OrderLabel;
use CCVShop\Api\Resources\OrderLabelCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class OrderLabels extends BaseEndpoint implements
    Get,
    Put
{
    protected string  $resourcePath       = 'orderlabels';
    protected ?string $parentResourcePath = 'orders';

    /**
     * @return OrderLabel()
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
     * @return OrderLabel
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): OrderLabel
    {
        if ($id === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $id));
        /**
         * @var OrderLabel $result
         */
        return $this->rest_getOne($id, []);
    }


    /**
     * @param int $id
     * @param array $parameters
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function put(int $id, array $parameters = []): void
    {
        if ($id === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $id));
        $this->rest_put($parameters);

    }
}
