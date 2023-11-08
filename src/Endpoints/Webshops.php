<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\AppCollection;
use CCVShop\Api\Resources\MerchantCollection;
use CCVShop\Api\Resources\Webshop;
use CCVShop\Api\Resources\WebshopCollection;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Webshops extends BaseEndpoint implements
    Get,
    GetAll
{
    protected string $resourcePath = 'webshops';
    protected ?string $parentResourcePath = 'merchant';

    /**
     * @return Webshop
     */
    protected function getResourceObject(): Webshop
    {
        return new Webshop($this->client);
    }

    /**
     * @return WebshopCollection
     */
    protected function getResourceCollectionObject(): WebshopCollection
    {
        return new WebshopCollection();
    }

    /**
     * @param int $id
     *
     * @return Webshop
     * @throws InvalidHashOnResult
     * @throws GuzzleException
     * @throws JsonException
     */
    public function get(int $id): Webshop
    {
        /** @var Webshop $result */
        $result = $this->rest_getOne($id, []);

        return $result;
    }

    /**
     * @param \CCVShop\Api\Resources\Merchant $merchant
     * @param array $parameters
     *
     * @return WebshopCollection
     */
    public function getFor(\CCVShop\Api\Resources\Merchant $merchant, array $parameters = []): WebshopCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($merchant));
        /** @var WebshopCollection $result */
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int $merchantId
     * @param array $parameters
     *
     * @return WebshopCollection
     * @throws InvalidHashOnResult
     * @throws GuzzleException
     */
    public function getForId(int $merchantId, array $parameters = []): WebshopCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->merchant->getResourcePath(), $merchantId));

        /** @var WebshopCollection $result */
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int $webshopId
     *
     * @return MerchantCollection
     * @throws InvalidHashOnResult
     * @throws GuzzleException
     */
    public function getMerchantsById(int $webshopId): MerchantCollection
    {
        return $this->client->merchant->getForId($webshopId);
    }

    /**
     * @param array $parameters
     *
     * @return WebshopCollection
     * @throws InvalidHashOnResult
     * @throws GuzzleException
     */
    public function getAll(array $parameters = []): WebshopCollection
    {
        /** @var WebshopCollection $result */
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
    }
}
