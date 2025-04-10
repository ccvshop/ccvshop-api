<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Redirect;
use CCVShop\Api\Resources\RedirectCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class Redirects extends BaseEndpoint implements
    Get,
    GetAll,
    Patch,
    Post,
    Delete
{
    protected string $resourcePath = 'redirects';

    /**
     * @return Redirect()
     */
    protected function getResourceObject(): Redirect
    {
        return new Redirect($this->client);
    }

    /**
     * @return RedirectCollection
     */
    protected function getResourceCollectionObject(): RedirectCollection
    {
        return new RedirectCollection();
    }

    /**
     * @param int $id
     * @return BaseResource
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): BaseResource
    {
        /** @var Redirect $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param array $parameters
     * @return RedirectCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getAll(array $parameters = []): RedirectCollection
    {
        /** @var RedirectCollection */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param Redirect|null $redirect
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function patch(?Redirect $redirect = null): void
    {
        if (is_null($redirect)) {
            throw new InvalidArgumentException(Redirect::class . ' required');
        }

        $data = [
            'source_url' => $redirect->source_url,
            'target_url' => $redirect->target_url,
            'active'     => $redirect->active,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $this->rest_patch($redirect->id, $data);
    }

    /**
     * @param Redirect|null $redirect
     * @return Redirect
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function post(?Redirect $redirect = null): Redirect
    {
        if (is_null($redirect)) {
            throw new InvalidArgumentException(Redirect::class . ' required');
        }

        $data = [
            'source_url' => $redirect->source_url,
            'target_url' => $redirect->target_url,
            'active'     => $redirect->active,
        ];

        // Filter the array to remove entries with null values
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        return $this->rest_post($data);
    }

    /**
     * @param int $id
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function delete(int $id): void
    {
        $this->rest_delete($id);
    }
}
