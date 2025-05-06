<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\AppCodeBlock;
use CCVShop\Api\Resources\ProductKeyword;
use CCVShop\Api\Resources\ProductKeywordCollection;
use CCVShop\Api\Resources\ProductPropertyOptionCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductKeywords extends BaseEndpoint implements
    Post
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
     * @param ProductKeyword|null $productKeyword
     * @return ProductKeyword
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function post(?ProductKeyword $productKeyword = null): ProductKeyword
    {
        if (is_null($productKeyword)) {
            throw new InvalidArgumentException(ProductKeyword::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $productKeyword->id));

        /** @var AppCodeBlock */
        return $this->rest_post([
            'items' => $productKeyword->items
        ]);
    }

    /**
     * @param ProductKeyword $productKeyword
     * @param array $parameters
     * @return ProductKeywordCollection
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getFor(ProductKeyword $productKeyword, array $parameters = []): ProductKeywordCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($productKeyword));
        /** @var ProductPropertyOptionCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
