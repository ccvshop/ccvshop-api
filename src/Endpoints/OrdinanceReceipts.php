<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\OrdinanceReceipt;
use CCVShop\Api\Resources\OrdinanceReceiptCollection;

class OrdinanceReceipts extends BaseEndpoint implements
    Get,
    GetAll,
    Post
{
    protected string $resourcePath = 'ordinancereceipts';
    protected ?string $parentResourcePath = 'orders';

    /**
     * @description Get the resource object
     * @return OrdinanceReceipt
     */
    protected function getResourceObject(): OrdinanceReceipt
    {
        return new OrdinanceReceipt($this->client);
    }

    /**
     * @description Get the resource collection object
     * @return OrdinanceReceiptCollection
     */
    protected function getResourceCollectionObject(): OrdinanceReceiptCollection
    {
        return new OrdinanceReceiptCollection();
    }

    /**
     * @description Get one by id
     * @param int $id
     * @return OrdinanceReceipt
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): OrdinanceReceipt
    {
        /** @var OrdinanceReceipt $result */
        $result = $this->rest_getOne($id, []);

        return $result;
    }

    /**
     * @description Get all by parameters
     * @param array $parameters
     * @return OrdinanceReceiptCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getAll(array $parameters = []): OrdinanceReceiptCollection
    {
        /** @var OrdinanceReceiptCollection $result */
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
    }


    /**
     * @description Post a ordinance receipt.
     * @param OrdinanceReceipt|null $receipt
     * @return BaseResource|OrdinanceReceipt
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function post(OrdinanceReceipt $receipt = null): OrdinanceReceipt
    {
        if ($receipt === null) {
            throw new \InvalidArgumentException(OrdinanceReceipt::class . ' required');
        }

        return $this->rest_post([
            'type' => $receipt->type,
            'ordinance_identifier' => $receipt->ordinance_identifier,
            'receipt_data' => $receipt->receipt_data
        ]);
    }

}
