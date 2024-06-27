<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Resources\App;
use CCVShop\Api\Resources\AppConfig;

class AppConfigs extends BaseEndpoint implements Patch
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
    protected function getResourceCollectionObject(): \CCVShop\Api\BaseResourceCollection
    {
        return new AppConfigCollection();
    }

    /**
     * Get an app code block.
     *
     * @param int $id
     * @return AppConfig
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): AppConfig
    {
        /** @var AppConfig */
        return $this->rest_getOne($id, []);
    }

    /**
     * Retrieve a collection of all app code blocks that are linked to the app.
     *
     * @param App $app
     * @param array $parameters
     * @return AppConfigCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function getFor(App $app, array $parameters = []): AppConfigCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($app));
        /** @var AppConfigCollection */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * Post an app code block.
     *
     * @param AppConfig|null $appCodeBlock
     * @return AppConfig
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?AppConfig $appConfig = null): void
    {
        if (is_null($appConfig)) {
            throw new \InvalidArgumentException(AppConfig::class . ' required');
        }

        /** @var AppConfig */
        $this->rest_patch($appConfig->id, [
            'jwt' => $appConfig->jwt
        ]);
    }

    /**
     * Delete a codeblock.
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function delete(int $id): void
    {
        $this->rest_delete($id);
    }
}
