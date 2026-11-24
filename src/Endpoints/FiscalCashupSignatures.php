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
use CCVShop\Api\Resources\CashUp;
use CCVShop\Api\Resources\FiscalCashupSignature;
use CCVShop\Api\Resources\FiscalCashupSignatureCollection;

class FiscalCashupSignatures extends BaseEndpoint implements Get, GetAll, Patch
{
    protected string $resourcePath = 'fiscalcashupsignatures';
    protected ?string $parentResourcePath = 'cashups';

    /**
     * @return FiscalCashupSignature
     */
    public function getResourceObject(): FiscalCashupSignature
    {
        return new FiscalCashupSignature($this->client);
    }

    /**
     * @return FiscalCashupSignatureCollection
     */
    public function getResourceCollectionObject(): FiscalCashupSignatureCollection
    {
        return new FiscalCashupSignatureCollection();
    }

    /**
     * @param int $id
     *
     * @return FiscalCashupSignature
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): FiscalCashupSignature
    {
        /** @var FiscalCashupSignature $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param CashUp                         $cashup
     * @param array<string,int|float|string> $parameters
     *
     * @return FiscalCashupSignatureCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(CashUp $cashup, array $parameters = []): FiscalCashupSignatureCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($cashup));

        /** @var FiscalCashupSignatureCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return FiscalCashupSignatureCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): FiscalCashupSignatureCollection
    {
        /** @var FiscalCashupSignatureCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param FiscalCashupSignature|null $signature
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function patch(?FiscalCashupSignature $signature = null): void
    {
        if ($signature === null) {
            throw new \InvalidArgumentException(FiscalCashupSignature::class . ' required');
        }

        $this->restPatch($signature);
    }
}
