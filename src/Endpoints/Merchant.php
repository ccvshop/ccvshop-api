<?php

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
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class Merchant extends BaseEndpoint implements
    Get,
    GetAll,
    Patch
{
    protected string  $resourcePath       = 'merchant';
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
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
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
     * @return MerchantCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
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
     * @return MerchantCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
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
     * @throws InvalidResponseException
     */
    public function patch(\CCVShop\Api\Resources\Merchant $merchant = null): void
    {
        if ($merchant === null) {
            throw new InvalidArgumentException(\CCVShop\Api\Resources\Merchant::class . ' required');
        }
        $this->rest_patch($merchant->id, [
            'uuid'                     => $merchant->uuid,
            'gender'                   => $merchant->gender,
            'first_name'               => $merchant->first_name,
            'last_name'                => $merchant->last_name,
            'company'                  => $merchant->company,
            'email'                    => $merchant->email,
            'street'                   => $merchant->street,
            'housenumber'              => $merchant->housenumber,
            'zipcode'                  => $merchant->zipcode,
            'city'                     => $merchant->city,
            'country_code'             => $merchant->country_code,
            'telephone'                => $merchant->telephone,
            'coc_number'               => $merchant->coc_number,
            'tax_number'               => $merchant->tax_number,
            'iban'                     => $merchant->iban,
            'bank_account_holder_name' => $merchant->bank_account_holder_name,
        ]);
    }

    /**
     * @param array $parameters
     *
     * @return MerchantCollection
     * @throws InvalidHashOnResult
     * @throws JsonException
     * @throws InvalidResponseException
     * @throws ReflectionException
     */
    public function getAll(array $parameters = []): MerchantCollection
    {
        /** @var MerchantCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
