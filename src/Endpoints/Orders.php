<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Resources\FiscalTransactionSignatureCollection;

class Orders extends BaseEndpoint
{
    protected string $resourcePath = 'orders';

    protected function getResourceObject(): BaseResource
    {
        return new \CCVShop\Api\Resources\Order($this->client);
    }

    protected function getResourceCollectionObject(): BaseResourceCollection
    {
        return new \CCVShop\Api\Resources\OrderCollection($this->client);
    }

    public function getFiscalTransactionSignaturesById(int $orderId): FiscalTransactionSignatureCollection
    {
        return $this->client->fiscalTransactionSignature->getForId($orderId);
    }
}
