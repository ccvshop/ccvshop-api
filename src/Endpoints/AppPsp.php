<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\AppPspCollection;

class AppPsp extends BaseEndpoint implements Get, GetAll, Post, Patch, Delete
{
    protected string $resourcePath = 'apppsp';

    /**
     * @return \CCVShop\Api\Resources\AppPsp
     */
    public function getResourceObject(): \CCVShop\Api\Resources\AppPsp
    {
        return new \CCVShop\Api\Resources\AppPsp($this->client);
    }

    /**
     * @return AppPspCollection
     */
    public function getResourceCollectionObject(): AppPspCollection
    {
        return new AppPspCollection();
    }

    public function get(int $id): BaseResource
    {
        /** @var \CCVShop\Api\Resources\AppPsp $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    public function getAll(array $parameters = []): BaseResourceCollection
    {
        /** @var AppPspCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    public function post(?\CCVShop\Api\Resources\AppPsp $appPsp = null): BaseResource
    {
        if ($appPsp === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\AppPsp::class . ' required');
        }

        return $this->restPost($appPsp);
    }

    public function patch(?\CCVShop\Api\Resources\AppPsp $appPsp = null): void
    {
        if ($appPsp === null) {
            throw new \InvalidArgumentException(\CCVShop\Api\Resources\AppPsp::class . ' required');
        }

        $this->restPatch($appPsp);
    }

    public function delete(int $id): void
    {
        $this->restDelete($id);
    }
}
