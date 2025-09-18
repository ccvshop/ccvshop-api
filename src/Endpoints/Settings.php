<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Resources\Setting;
use CCVShop\Api\Resources\SettingCollection;
use GuzzleHttp\Exception\GuzzleException;

class Settings extends BaseEndpoint
{
    protected string $resourcePath = 'settings';
    protected ?string $parentResourcePath = 'webshops';

    /**
     * @description Get the resource object
     *
     * @return Setting
     */
    public function getResourceObject(): Setting
    {
        return new Setting($this->client);
    }

    /**
     * @description Get the resource collection object
     *
     * @return SettingCollection
     */
    public function getResourceCollectionObject(): SettingCollection
    {
        return new SettingCollection();
    }

    /**
     * @description Get all by parameters
     *
     * @param int $iWebsiteId
     *
     * @return SettingCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(int $iWebsiteId): SettingCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->settings->getParentResourcePath(), $iWebsiteId));

        /** @var SettingCollection $result */
        $result = $this->restGetAll();

        return $result;
    }

    /**
     * @param int          $iWebsiteId
     * @param Setting|null $settings
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function putFor(int $iWebsiteId, ?Setting $settings = null): void
    {
        if (is_null($settings)) {
            throw new \InvalidArgumentException(__CLASS__ . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->settings->getParentResourcePath(), $iWebsiteId));

        $this->restPut($settings);
    }
}
