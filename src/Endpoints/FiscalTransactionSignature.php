<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\FiscalTransactionSignatureCollection;

class FiscalTransactionSignature extends BaseEndpoint implements
    Get,
    GetAll,
    Post
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
    public function post(\CCVShop\Api\Resources\FiscalTransactionSignature $signature = null): \CCVShop\Api\Resources\FiscalTransactionSignature
    {
        if ($signature === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\FiscalTransactionSignature::class . ' required');
        }

        return $this->rest_post([
            'create_date' => $signature->create_date,
            'type' => $signature->type,
            'ordinance_identifier' => $signature->ordinance_identifier,
            'signature_data' => $signature->signature_data
        ]);
    }

}
