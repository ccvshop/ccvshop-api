<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Resources\MerchantCollection;
use CCVShop\Api\Resources\Webshop;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Merchant extends BaseEndpoint implements
    Get,
    GetAll,
    Patch
{
    protected string $resourcePath = 'merchant';
    protected ?string $parentResourcePath = 'webshops';

    /**
     * @return \CCVShop\Api\Resources\Merchant
     */
    protected function getResourceObject(): \CCVShop\Api\Resources\Merchant
    {
        return new \CCVShop\Api\Resources\Merchant($this->client);
    }

    /**
     * @return MerchantCollection
     */
    protected function getResourceCollectionObject(): MerchantCollection
    {
        return new MerchantCollection();
    }

    /**
     * @param int $id
     *
     * @return BaseResource|\CCVShop\Api\Resources\Merchant
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws JsonException
     */
    public function get(int $id): \CCVShop\Api\Resources\Merchant
    {
        /** @var \CCVShop\Api\Resources\Merchant $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param Webshop $webshop
     * @param array $parameters
     *
     * @return BaseResourceCollection|MerchantCollection
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     */
    public function getFor(Webshop $webshop, array $parameters = []): MerchantCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($webshop));
        /** @var MerchantCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param int $webshopId
     * @param array $parameters
     *
     * @return BaseResourceCollection|MerchantCollection
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     */
    public function getForId(int $webshopId, array $parameters = []): MerchantCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->webshops->getResourcePath(), $webshopId));

        /** @var MerchantCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param \CCVShop\Api\Resources\Merchant|null $merchant
     * @return void
     * @throws InvalidHashOnResult
     * @throws JsonException
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     */
    public function patch(\CCVShop\Api\Resources\Merchant $merchant = null): void
    {
        if ($merchant === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\Merchant::class . ' required');
        }
        $this->rest_patch($merchant->id, [
            'uuid' => $merchant->uuid,
        ]);
    }

    /**
     * @param array $parameters
     *
     * @return BaseResourceCollection|MerchantCollection
     * @throws InvalidHashOnResult
     * @throws GuzzleException
     */
    public function getAll(array $parameters = []): MerchantCollection
    {
        /** @var MerchantCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
