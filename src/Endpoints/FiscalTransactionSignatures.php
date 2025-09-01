<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\FiscalTransactionSignature;
use CCVShop\Api\Resources\FiscalTransactionSignatureCollection;
use CCVShop\Api\Resources\Order;

class FiscalTransactionSignatures extends BaseEndpoint implements Get, GetAll, Post, Patch
{
    protected string $resourcePath = 'fiscaltransactionsignatures';
    protected ?string $parentResourcePath = 'orders';

    /**
     * @description Get the resource object
     *
     * @return FiscalTransactionSignature
     */
    protected function getResourceObject(): FiscalTransactionSignature
    {
        return new FiscalTransactionSignature($this->client);
    }

    /**
     * @description Get the resource collection object
     *
     * @return FiscalTransactionSignatureCollection
     */
    protected function getResourceCollectionObject(): FiscalTransactionSignatureCollection
    {
        return new FiscalTransactionSignatureCollection();
    }

    /**
     * @description Get one by id
     *
     * @param int $id
     *
     * @return FiscalTransactionSignature
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): FiscalTransactionSignature
    {
        /** @var FiscalTransactionSignature $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @description Get all fiscal transaction signatures by order resource.
     *
     * @param Order                          $order
     * @param array<string,int|float|string> $parameters
     *
     * @return FiscalTransactionSignatureCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(Order $order, array $parameters = []): FiscalTransactionSignatureCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($order));

        /** @var FiscalTransactionSignatureCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @description Get all by parameters
     *
     * @param array<string,int|float|string> $parameters
     *
     * @return FiscalTransactionSignatureCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): FiscalTransactionSignatureCollection
    {
        /** @var FiscalTransactionSignatureCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @description Post a fiscal transaction signature.
     *
     * @param FiscalTransactionSignature|null $signature
     *
     * @return FiscalTransactionSignature
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function post(?int $orderId = null, ?FiscalTransactionSignature $signature = null): FiscalTransactionSignature
    {
        if ($orderId === null) {
            throw new \InvalidArgumentException('order id is required');
        }
        if ($signature === null) {
            throw new \InvalidArgumentException(FiscalTransactionSignature::class . ' required');
        }
        $this->setParent(ResourceFactory::createParent($this->client->orders->getResourcePath(), $orderId));

        /** @var FiscalTransactionSignature $result */
        $result = $this->restPost($signature);

        return $result;
    }

    /**
     * @description Patch a fiscal transaction signature.
     *
     * @param FiscalTransactionSignature|null $signature
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?FiscalTransactionSignature $signature = null): void
    {
        if ($signature === null) {
            throw new \InvalidArgumentException(FiscalTransactionSignature::class . ' required');
        }

        $this->restPatch($signature);
    }
}
