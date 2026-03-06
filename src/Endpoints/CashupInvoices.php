<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\GetFor;
use CCVShop\Api\Resources\Cashup;
use CCVShop\Api\Resources\CashupInvoice;
use CCVShop\Api\Resources\CashupInvoicesCollection;

class CashupInvoices extends BaseEndpoint implements GetFor
{
    protected string $resourcePath = 'cashupinvoices';
    protected ?string $parentResourcePath = 'cashups';

    /**
     * @description Get the resource object
     *
     * @return CashupInvoice
     */
    public function getResourceObject(): CashupInvoice
    {
        return new CashupInvoice($this->client);
    }

    /**
     * @description Get the resource collection object
     *
     * @return CashupInvoicesCollection
     */
    public function getResourceCollectionObject(): CashupInvoicesCollection
    {
        return new CashupInvoicesCollection();
    }

    /**
     * @param Cashup|null                    $cashup
     * @param array<string,int|float|string> $filters
     *
     * @return CashupInvoicesCollection
     *
     * @throws \CCVShop\Api\Exceptions\InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(?Cashup $cashup = null, array $filters = []): CashupInvoicesCollection
    {
        if ($cashup === null) {
            throw new \InvalidArgumentException('Cashup cannot be null');
        }
        $this->setParent(ResourceFactory::createParentFromResource($cashup));

        /** @var CashupInvoicesCollection $result */
        $result = $this->restGetAll(null, null, $filters);

        return $result;
    }
}
