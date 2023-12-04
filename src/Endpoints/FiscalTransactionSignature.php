<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\FiscalTransactionSignatureCollection;
use CCVShop\Api\Resources\Order;

class FiscalTransactionSignature extends BaseEndpoint implements
    Get,
    GetAll,
    Post,
    Patch
{
    protected string $resourcePath = 'fiscaltransactionsignature';
    protected ?string $parentResourcePath = 'orders';

    /**
     * @description Get the resource object
     * @return \CCVShop\Api\Resources\FiscalTransactionSignature;
     */
    protected function getResourceObject(): \CCVShop\Api\Resources\FiscalTransactionSignature
    {
        return new \CCVShop\Api\Resources\FiscalTransactionSignature($this->client);
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
     * @return \CCVShop\Api\Resources\FiscalTransactionSignature
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): \CCVShop\Api\Resources\FiscalTransactionSignature
    {
        /** @var \CCVShop\Api\Resources\FiscalTransactionSignature $result */
        $result = $this->rest_getOne($id, []);

        return $result;
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
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
    }


    /**
     * @description Get all fiscal transaction signatures by order id.
     * @param int $orderId
     * @param array $parameters
     * @return FiscalTransactionSignatureCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getForId(int $orderId, array $parameters = []): FiscalTransactionSignatureCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->orders->getResourcePath(), $orderId));

        /** @var FiscalTransactionSignatureCollection $result */
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
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
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
    }

    /**
     * @description Post a fiscal transaction signature.
     * @param \CCVShop\Api\Resources\FiscalTransactionSignature|null $signature
     * @return BaseResource|FiscalTransactionSignature
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function post(int $orderId = null, \CCVShop\Api\Resources\FiscalTransactionSignature $signature = null): \CCVShop\Api\Resources\FiscalTransactionSignature
    {
        if ($orderId === null) {
            throw new \InvalidArgumentException('order id is required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->orders->getResourcePath(), $orderId));

        if ($signature === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\FiscalTransactionSignature::class . ' required');
        }

        return $this->rest_post([
            'create_date' => $signature->create_date,
            'type' => $signature->type,
            'signature_identifier' => $signature->signature_identifier,
            'signature_data' => $signature->signature_data
        ]);
    }

    /**
     * @description Patch a fiscal transaction signature.
     * @param \CCVShop\Api\Resources\FiscalTransactionSignature|null $signature
     * @return void
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function patch(\CCVShop\Api\Resources\FiscalTransactionSignature $signature = null): void
    {
        if ($signature === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\FiscalTransactionSignature::class . ' required');
        }

        $this->rest_patch($signature->id, [
            'signature_data' => $signature->signature_data
        ]);
    }
}
