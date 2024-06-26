<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\App;
use CCVShop\Api\Resources\AppConfig;

class AppConfig extends BaseEndpoint implements Post
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
    protected function getResourceCollectionObject(): AppConfigCollection
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
    public function post(?AppConfig $appCodeBlock = null): AppConfig
    {
        if (is_null($appCodeBlock)) {
            throw new \InvalidArgumentException(AppConfig::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->apps->getResourcePath(), $appCodeBlock->app_id));

        /** @var AppConfig */
        return $this->rest_post([
            'placeholder' => $appCodeBlock->placeholder,
            'value' => $appCodeBlock->value,
            'title' => $appCodeBlock->title,
            'interactive_content' => $appCodeBlock->interactive_content,
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
