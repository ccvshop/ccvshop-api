<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\PutFor;
use CCVShop\Api\Resources\Product;
use CCVShop\Api\Resources\ProductLabel;
use CCVShop\Api\Resources\ProductLabelCollection;

class ProductLabels extends BaseEndpoint implements Get, PutFor
{
    protected string $resourcePath = 'productlabels';
    protected ?string $parentResourcePath = 'products';

    /**
     * @return ProductLabel
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
     *
     * @return ProductLabel
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): ProductLabel
    {
        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $id));

        /**
         * @var ProductLabel $result
         */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @return void
     *
     * @deprecated \CCVShop\Api\Endpoints\ProductLabels::putFor
     */
    public function put(): void
    {
        trigger_error('Use ProductLabels::putFor()', E_USER_ERROR);
    }

    public function putFor(?Product $product = null, ?ProductLabelCollection $productLabelCollection = null): void
    {
        if ($product === null) {
            throw new \InvalidArgumentException('Missing required parameter: Product');
        }
        if ($productLabelCollection === null) {
            throw new \InvalidArgumentException('Missing required parameter: ProductLabelCollection');
        }

        $this->setParent(ResourceFactory::createParent($this->client->products->getResourcePath(), $product->id));

        $this->restPut($productLabelCollection);
    }
}
