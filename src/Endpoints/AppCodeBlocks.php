<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\App;
use CCVShop\Api\Resources\AppCodeBlock;
use CCVShop\Api\Resources\AppCodeBlockCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class AppCodeBlocks extends BaseEndpoint implements
    Get,
    Post,
    Delete
{
    protected string  $resourcePath       = 'appcodeblocks';
    protected ?string $parentResourcePath = 'apps';


    /**
     * @return AppCodeBlock
     */
    protected function getResourceObject(): AppCodeBlock
    {
        return new AppCodeBlock($this->client);
    }

    /**
     * @return AppCodeBlockCollection
     */
    protected function getResourceCollectionObject(): AppCodeBlockCollection
    {
        return new AppCodeBlockCollection();
    }

    /**
     * Get an app code block.
     *
     * @param int $id
     * @return AppCodeBlock
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): AppCodeBlock
    {
        /** @var AppCodeBlock */
        return $this->rest_getOne($id, []);
    }

    /**
     * Retrieve a collection of all app code blocks that are linked to the app.
     *
     * @param App $app
     * @param array $parameters
     * @return AppCodeBlockCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getFor(App $app, array $parameters = []): AppCodeBlockCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($app));
        /** @var AppCodeBlockCollection */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * Post an app code block.
     *
     * @param AppCodeBlock|null $appCodeBlock
     * @return AppCodeBlock
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function post(?AppCodeBlock $appCodeBlock = null): AppCodeBlock
    {
        if (is_null($appCodeBlock)) {
            throw new InvalidArgumentException(AppCodeBlock::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->apps->getResourcePath(), $appCodeBlock->app_id));

        /** @var AppCodeBlock */
        return $this->rest_post([
            'placeholder'         => $appCodeBlock->placeholder,
            'value'               => $appCodeBlock->value,
            'title'               => $appCodeBlock->title,
            'interactive_content' => $appCodeBlock->interactive_content,
        ]);
    }

    /**
     * Delete a codeblock.
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
