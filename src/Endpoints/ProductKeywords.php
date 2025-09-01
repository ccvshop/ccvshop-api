<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductKeyword;
use CCVShop\Api\Resources\ProductKeywordCollection;
use GuzzleHttp\Exception\GuzzleException;

class ProductKeywords extends BaseEndpoint
{
    protected string $resourcePath = 'productkeywords';
    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductKeyword
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
     * @param int|null            $productId
     * @param ProductKeyword|null $productKeyword
     *
     * @return ProductKeyword
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     * @throws GuzzleException
     */
    public function post(?int $productId = null, ?ProductKeyword $productKeyword = null): ProductKeyword
    {
        if ($productId === null) {
            throw new \InvalidArgumentException('product id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $productId));

        if ($productKeyword === null) {
            throw new \InvalidArgumentException(ProductKeyword::class . ' required');
        }

        /** @var ProductKeyword $result */
        $result = $this->restPost($productKeyword);

        return $result;
    }

    /**
     * @param Product                        $product
     * @param array<string,int|float|string> $parameters
     *
     * @return ProductKeywordCollection
     *
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(Product $product, array $parameters = []): ProductKeywordCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($product));

        /** @var ProductKeywordCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
