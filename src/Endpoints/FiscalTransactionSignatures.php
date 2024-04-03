<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\FiscalTransactionSignature;
use CCVShop\Api\Resources\FiscalTransactionSignatureCollection;
use CCVShop\Api\Resources\Order;

class FiscalTransactionSignatures extends BaseEndpoint implements
    Get,
    GetAll,
    Post,
    Patch
{
    protected string $resourcePath = 'fiscaltransactionsignatures';
    protected ?string $parentResourcePath = 'orders';

    /**
     * @description Get the resource object
     * @return FiscalTransactionSignature;
     */
    protected function getResourceObject(): FiscalTransactionSignature
    {
        return new FiscalTransactionSignature($this->client);
    }

    /**
     * @description Get the resource collection object
     * @return FiscalTransactionSignatureCollection
     */
    protected function getResourceCollectionObject(): FiscalTransactionSignatureCollection
    {
        return new FiscalTransactionSignatureCollection();
    }

    /**
     * @description Get one by id
     * @param int $id
     * @return FiscalTransactionSignature
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): FiscalTransactionSignature
    {
        /** @var FiscalTransactionSignature $result */
        return $this->rest_getOne($id, []);
    }


    /**
     * @description Get all fiscal transaction signatures by order resource.
     * @param Order $order
     * @param array $parameters
     * @return FiscalTransactionSignatureCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getFor(Order $order, array $parameters = []): FiscalTransactionSignatureCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($order));
        /** @var FiscalTransactionSignatureCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @description Get all by parameters
     * @param array $parameters
     * @return FiscalTransactionSignatureCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getAll(array $parameters = []): FiscalTransactionSignatureCollection
    {
        /** @var FiscalTransactionSignatureCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @description Post a fiscal transaction signature.
     * @param FiscalTransactionSignature|null $signature
     * @return FiscalTransactionSignature
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function post(int $orderId = null, FiscalTransactionSignature $signature = null): FiscalTransactionSignature
    {
        if ($orderId === null) {
            throw new \InvalidArgumentException('order id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->orders->getResourcePath(), $orderId));

        if ($signature === null) {
            throw new \InvalidArgumentException(FiscalTransactionSignature::class . ' required');
        }

        return $this->rest_post([
            'create_date' => $signature->create_date->format('Y-m-d\TH:i:s\Z'),
            'type' => $signature->type,
            'signature_identifier' => $signature->signature_identifier,
            'signature_data' => $signature->signature_data
        ]);
    }

    /**
     * @description Patch a fiscal transaction signature.
     * @param FiscalTransactionSignature|null $signature
     * @return void
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function patch(FiscalTransactionSignature $signature = null): void
    {
        if ($signature === null) {
            throw new \InvalidArgumentException(FiscalTransactionSignature::class . ' required');
        }

        $this->rest_patch($signature->id, [
            'signature_data' => $signature->signature_data
        ]);
    }
}
