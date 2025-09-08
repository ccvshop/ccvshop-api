<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Webhook;
use CCVShop\Api\Resources\WebhookCollection;

class Webhooks extends BaseEndpoint implements Get, GetAll, Patch, Post, Delete
{
    protected string $resourcePath = 'webhooks';

    /**
     * @return Webhook
     */
    protected function getResourceObject(): Webhook
    {
        return new Webhook($this->client);
    }

    /**
     * @return WebhookCollection
     */
    protected function getResourceCollectionObject(): WebhookCollection
    {
        return new WebhookCollection();
    }

    /**
     * @param int $id
     *
     * @return Webhook
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): Webhook
    {
        /** @var Webhook $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return WebhookCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): WebhookCollection
    {
        /** @var WebhookCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param Webhook|null $webhook
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function patch(?Webhook $webhook = null): void
    {
        if ($webhook === null) {
            throw new \InvalidArgumentException(Webhook::class . ' required');
        }

        $this->restPatch($webhook);
    }

    /**
     * @param Webhook|null $webhook
     *
     * @return Webhook
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function post(?Webhook $webhook = null): Webhook
    {
        if ($webhook === null) {
            throw new \InvalidArgumentException(Webhook::class . ' required');
        }
        /** @var Webhook $result */
        $result = $this->restPost($webhook);

        return $result;
    }

    /**
     * @param int $id
     *
     * @return void
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
