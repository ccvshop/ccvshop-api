<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Resources\ProductKeyword;
use CCVShop\Api\Resources\ProductKeywordCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class ProductKeywords extends BaseEndpoint
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
     * @param int|null $productId
     * @param ProductKeyword|null $productKeyword
     * @return ProductKeyword
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function post(int $productId = null, ProductKeyword $productKeyword = null): ProductKeyword
    {
        if ($productId === null) {
            throw new InvalidArgumentException('product id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $productId));

        if ($productKeyword === null) {
            throw new InvalidArgumentException(ProductKeyword::class . ' required');
        }

        $data = [
            'keyword' => $productKeyword

        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($data);
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
        /** @var ProductKeywordCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
