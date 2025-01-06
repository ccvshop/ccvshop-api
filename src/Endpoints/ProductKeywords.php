<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Put;
use CCVShop\Api\Resources\ProductLabel;
use CCVShop\Api\Resources\ProductLabelCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductKeywords extends BaseEndpoint implements
    Get,
    Post,
    Delete
{
    protected string  $resourcePath       = 'productkeywords';
    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductLabel()
     */
    protected function getResourceObject(): ProductLabel
    {
        return new ProductLabel($this->client);
    }

    /**
     * @return ProductLabelCollection
     */
    protected function getResourceCollectionObject(): ProductLabelCollection
    {
        return new ProductLabelCollection();
    }

    /**
     * @param int $id
     * @return ProductLabel
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductLabel
    {
        if ($id === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $id));
        /**
         * @var ProductLabel $result
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
