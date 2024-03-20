<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\AppCodeBlock;
use CCVShop\Api\Resources\AppCodeBlockCollection;

class AppCodeBlocks extends BaseEndpoint implements
    Get,
    Post
{
    protected string $resourcePath = 'AppCodeBlocks';

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
     * @param int $id
     * @return AppCodeBlock
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function get(int $id): AppCodeBlock
    {
        /** @var AppCodeBlock $result */
        $result = $this->rest_getOne($id, []);

        return $result;
    }

    /**
     * @param AppCodeBlock|null $appCodeBlock
     * @return AppCodeBlock
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \JsonException
     */
    public function post(?AppCodeBlock $appCodeBlock = null): AppCodeBlock
    {
        if (is_null($appCodeBlock)) {
            throw new \InvalidArgumentException(AppCodeBlock::class . ' required');
        }

        $this->setParent(ResourceFactory::createParent($this->client->apps->getResourcePath(), $appCodeBlock->app_id));

        /** @var AppCodeBlock $result */
        $result = $this->rest_post([
            'placeholder' => $appCodeBlock->placeholder,
            'value' => $appCodeBlock->value,
            'title' => $appCodeBlock->title,
            'interactive_content' => $appCodeBlock->interactive_content,
        ]);

        return $result;
    }
}
