<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\AppPspPaymethodCollection;

class AppPspPaymethods extends BaseEndpoint implements Get, GetAll, Post, Patch, Delete
{
    protected string $resourcePath = 'appppspaymethods';

    /**
     * @return \CCVShop\Api\Resources\AppPspPaymethod
     */
    public function getResourceObject(): \CCVShop\Api\Resources\AppPspPaymethod
    {
        return new \CCVShop\Api\Resources\AppPspPaymethod($this->client);
    }

    /**
     * @return AppPspPaymethodCollection
     */
    public function getResourceCollectionObject(): AppPspPaymethodCollection
    {
        return new AppPspPaymethodCollection();
    }

    public function get(int $id): BaseResource
    {
        /** @var \CCVShop\Api\Resources\AppPsp $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    public function getAll(array $parameters = []): BaseResourceCollection
    {
        /** @var AppPspPaymethodCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    public function post(?\CCVShop\Api\Resources\AppPsp $appPsp = null, ?\CCVShop\Api\Resources\AppPspPaymethod $appPspPaymethod = null): BaseResource
    {
        if ($appPsp === null) {
            throw new \InvalidArgumentException('AppPsp is required');
        }
        if ($appPspPaymethod === null) {
            throw new \InvalidArgumentException('AppPspPaymethod is required');
        }
        $this->setParent(ResourceFactory::createParent($this->client->appPsp->getResourcePath(), $appPsp->getId()));

        return $this->restPost($appPspPaymethod);
    }

    public function patch(?\CCVShop\Api\Resources\AppPspPaymethod $appPspPaymethod = null): void
    {
        if ($appPspPaymethod === null) {
            throw new \InvalidArgumentException('AppPspPaymethod is required');
        }
        $this->restPatch($appPspPaymethod);
    }

    public function delete(int $id): void
    {
        $this->restDelete($id);
    }
}
