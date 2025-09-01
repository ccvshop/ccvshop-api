<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Label;
use CCVShop\Api\Resources\LabelCollection;
use GuzzleHttp\Exception\GuzzleException;

class Labels extends BaseEndpoint implements Get, GetAll, Post, Delete
{
    protected string $resourcePath = 'labels';

    /**
     * @description Get the resource object
     *
     * @return Label
     */
    protected function getResourceObject(): Label
    {
        return new Label($this->client);
    }

    /**
     * @description Get the resource collection object
     *
     * @return LabelCollection
     */
    protected function getResourceCollectionObject(): LabelCollection
    {
        return new LabelCollection();
    }

    /**
     * @description Get one by id
     *
     * @param int $id
     *
     * @return Label
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function get(int $id): Label
    {
        /** @var Label $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @description Get all by parameters
     *
     * @param array<string,int|float|string> $parameters
     *
     * @return LabelCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws \JsonException|\ReflectionException
     */
    public function getAll(array $parameters = []): LabelCollection
    {
        /** @var LabelCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param Label|null $label
     *
     * @return Label
     *
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?Label $label = null): Label
    {
        if ($label === null) {
            throw new \InvalidArgumentException(Label::class . ' required');
        }
        /** @var Label $result */
        $result = $this->restPost($label);

        return $result;
    }

    /**
     * @param int $id
     *
     * @return void
     *
     * @throws GuzzleException
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function delete(int $id): void
    {
        $this->restDelete($id);
    }
}
