<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Resources\Merchant;
use CCVShop\Api\Resources\MerchantCollection;
use CCVShop\Api\Resources\Webshop;
use CCVShop\Api\Resources\WebshopCollection;

class Webshops extends BaseEndpoint implements Get, GetAll
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
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): Webshop
    {
        /** @var Webshop $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param Merchant                       $merchant
     * @param array<string,int|float|string> $parameters
     *
     * @return WebshopCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(Merchant $merchant, array $parameters = []): WebshopCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($merchant));

        /** @var WebshopCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int                            $merchantId
     * @param array<string,int|float|string> $parameters
     *
     * @return WebshopCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getForId(int $merchantId, array $parameters = []): WebshopCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->merchant->getResourcePath(), $merchantId));

        /** @var WebshopCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int $webshopId
     *
     * @return MerchantCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getMerchantsById(int $webshopId): MerchantCollection
    {
        return $this->client->merchant->getForId($webshopId);
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return WebshopCollection
     *
     * @throws InvalidHashOnResult
     * @throws \JsonException
     * @throws InvalidResponseException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): WebshopCollection
    {
        /** @var WebshopCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
