<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\App;
use CCVShop\Api\Resources\AppConfig;
use CCVShop\Api\Resources\AppConfigCollection;
use GuzzleHttp\Exception\GuzzleException;

class AppConfigs extends BaseEndpoint implements Patch, Post, Delete
{
    protected string $resourcePath = 'appconfig';
    protected ?string $parentResourcePath = 'apps';

    /**
     * @return AppConfig
     */
    protected function getResourceObject(): AppConfig
    {
        return new AppConfig($this->client);
    }

    /**
     * @return AppConfigCollection
     */
    protected function getResourceCollectionObject(): BaseResourceCollection
    {
        return new AppConfigCollection();
    }

    /**
     * Get an app code block.
     *
     * @param int $id
     *
     * @return AppConfig
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): AppConfig
    {
        /** @var AppConfig $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * Retrieve a collection of all app code blocks that are linked to the app.
     *
     * @param App                            $app
     * @param array<string,int|float|string> $parameters
     *
     * @return AppConfigCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(App $app, array $parameters = []): AppConfigCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($app));

        /** @var AppConfigCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * Post an app code block.
     *
     * @param AppConfig|null $appConfig
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?AppConfig $appConfig = null): void
    {
        if (is_null($appConfig)) {
            throw new \InvalidArgumentException(AppConfig::class . ' required');
        }

        $this->restPatch($appConfig);
    }

    /**
     * @param AppConfig|null $appConfig
     *
     * @return AppConfig
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws \JsonException|\ReflectionException
     */
    public function post(?AppConfig $appConfig = null): AppConfig
    {
        if (is_null($appConfig)) {
            throw new \InvalidArgumentException(AppConfig::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->apps->getResourcePath(), $appConfig->app_id));

        /** @var AppConfig $result */
        $result = $this->restPost($appConfig);

        return $result;
    }

    /**
     * Delete an app config.
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function delete(int $id): void
    {
        $this->restDelete($id);
    }
}
