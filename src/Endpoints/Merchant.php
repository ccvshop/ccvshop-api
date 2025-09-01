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
use CCVShop\Api\Resources\MerchantCollection;
use CCVShop\Api\Resources\Webshop;

class Merchant extends BaseEndpoint implements Get, GetAll, Patch
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
     * @return \CCVShop\Api\Resources\Merchant
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): \CCVShop\Api\Resources\Merchant
    {
        /** @var \CCVShop\Api\Resources\Merchant $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param Webshop                        $webshop
     * @param array<string,int|float|string> $parameters
     *
     * @return MerchantCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(Webshop $webshop, array $parameters = []): MerchantCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($webshop));

        /** @var MerchantCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int                            $webshopId
     * @param array<string,int|float|string> $parameters
     *
     * @return MerchantCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getForId(int $webshopId, array $parameters = []): MerchantCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->webshops->getResourcePath(), $webshopId));

        /** @var MerchantCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param \CCVShop\Api\Resources\Merchant|null $merchant
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws \JsonException
     * @throws InvalidResponseException
     */
    public function patch(?\CCVShop\Api\Resources\Merchant $merchant = null): void
    {
        if ($merchant === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\Merchant::class . ' required');
        }
        $this->restPatch($merchant);
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return MerchantCollection
     *
     * @throws InvalidHashOnResult
     * @throws \JsonException
     * @throws InvalidResponseException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): MerchantCollection
    {
        /** @var MerchantCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
