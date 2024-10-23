<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\App;
use CCVShop\Api\Resources\AppMessage;
use CCVShop\Api\Resources\AppMessageCollection;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class AppMessages extends BaseEndpoint implements Post, Delete
{
    protected string  $resourcePath       = 'appmessages';
    protected ?string $parentResourcePath = 'apps';

    /**
     * @return AppMessage
     */
    protected function getResourceObject(): AppMessage
    {
        return new AppMessage($this->client);
    }

    /**
     * @return AppMessageCollection
     */
    protected function getResourceCollectionObject(): BaseResourceCollection
    {
        return new AppMessageCollection();
    }

    /**
     * Get an app message.
     *
     * @param int $id
     * @return AppMessage
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): AppMessage
    {
        /** @var AppMessage */
        return $this->rest_getOne($id, []);
    }

    /**
     * Retrieve a collection of all app messages that are linked to the app.
     *
     * @param App $app
     * @param array $parameters
     * @return AppMessageCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getFor(App $app, array $parameters = []): AppMessageCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($app));
        /** @var AppMessageCollection */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param AppMessage|null $appMessage
     * @return AppMessage
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws JsonException|ReflectionException
     */
    public function post(?AppMessage $appMessage = null): AppMessage
    {
        if (is_null($appMessage)) {
            throw new InvalidArgumentException(AppMessage::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->apps->getResourcePath(), $appMessage->app_id));

        $data = [
            'type'    => $appMessage->type,
            'message' => $appMessage->message,
            'level'   => $appMessage->level,
        ];

        if (!empty($appMessage->icon)) {
            $data['icon'] = $appMessage->icon;
        }

        /** @var AppMessage */
        return $this->rest_post($data);
    }

    /**
     * Delete an app config.
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function delete(int $id): void
    {
        $this->rest_delete($id);
    }
}
