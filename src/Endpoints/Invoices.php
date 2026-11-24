<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Invoice;
use CCVShop\Api\Resources\InvoiceCollection;

class Invoices extends BaseEndpoint implements Get, GetAll
{
    protected string $resourcePath = 'invoices';

    /**
     * @return Invoice
     */
    public function getResourceObject(): Invoice
    {
        return new Invoice($this->client);
    }

    /**
     * @return InvoiceCollection
     */
    public function getResourceCollectionObject(): InvoiceCollection
    {
        return new InvoiceCollection();
    }

    /**
     * @description Get one by id
     *
     * @param int $id
     *
     * @return Invoice
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): Invoice
    {
        /** @var Invoice $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @description get all invoices linked to the website.
     *
     * @param array<string, int|float|string> $parameters
     *
     * @return InvoiceCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): InvoiceCollection
    {
        /** @var InvoiceCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
