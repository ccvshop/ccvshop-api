<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResourceCollection;

class ElementCollection extends BaseResourceCollection
{
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
}
