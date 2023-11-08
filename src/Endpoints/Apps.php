<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Resources\App;
use CCVShop\Api\Resources\AppCollection;

class Apps extends BaseEndpoint implements
    Get,
    GetAll,
    Patch
{
    protected string $resourcePath = 'apps';

    /**
     * @return App
     */
    protected function getResourceObject(): App
    {
        return new App($this->client);
    }

    /**
     * @return AppCollection
     */
    protected function getResourceCollectionObject(): AppCollection
    {
        return new AppCollection();
    }

    /**
     * @param int $id
     * @return App
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): App
    {
        /** @var App $result */
        $result = $this->rest_getOne($id, []);

        return $result;
    }

    /**
     * @param array $parameters
     * @return AppCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getAll(array $parameters = []): AppCollection
    {
        /** @var AppCollection $result */
        $result = $this->rest_getAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param App|null $app
     * @return void
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?App $app = null): void
    {
        if ($app === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\App::class . ' required');
        }

        $this->rest_patch($app->id, [
            'is_installed' => $app->is_installed
        ]);
    }
}
