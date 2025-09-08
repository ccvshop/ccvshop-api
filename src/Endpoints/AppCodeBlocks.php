<?php

declare(strict_types=1);

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

class AppCodeBlocks extends BaseEndpoint implements Get, Post, Delete
{
    protected string $resourcePath = 'appcodeblocks';
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
     *
     * @return AppCodeBlock
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): AppCodeBlock
    {
        /** @var AppCodeBlock $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * Retrieve a collection of all app code blocks that are linked to the app.
     *
     * @param App                            $app
     * @param array<string,int|float|string> $parameters
     *
     * @return AppCodeBlockCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(App $app, array $parameters = []): AppCodeBlockCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($app));

        /** @var AppCodeBlockCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * Post an app code block.
     *
     * @param AppCodeBlock|null $appCodeBlock
     *
     * @return AppCodeBlock
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function post(?AppCodeBlock $appCodeBlock = null): AppCodeBlock
    {
        if (is_null($appCodeBlock)) {
            throw new \InvalidArgumentException(AppCodeBlock::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->apps->getResourcePath(), $appCodeBlock->app_id));

        /** @var AppCodeBlock $result */
        $result = $this->restPost($appCodeBlock);

        return $result;
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
        $this->restDelete($id);
    }
}
