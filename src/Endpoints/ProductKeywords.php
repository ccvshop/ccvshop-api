<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\ProductKeyword;
use CCVShop\Api\Resources\ProductKeywordCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductKeywords extends BaseEndpoint implements
    Get
{
    protected string  $resourcePath       = 'productkeywords';
    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductKeyword()
     */
    protected function getResourceObject(): ProductKeyword
    {
        return new ProductKeyword($this->client);
    }

    /**
     * @return ProductKeywordCollection
     */
    protected function getResourceCollectionObject(): ProductKeywordCollection
    {
        return new ProductKeywordCollection();
    }

    /**
     * @param int $id
     * @return ProductKeyword
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): ProductKeyword
    {
        if ($id === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $id));

        /**
         * @var ProductKeyword $result
         */
        $result = $this->rest_getOne($id, []);

        return $result;
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function post(int $id, array $parameters = [])
    {
        if ($id === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $parent = ResourceFactory::createParent($this->client->products->getResourcePath(), $id);
        $this->setParent($parent);
        $this->rest_post($parameters);
    }
}
