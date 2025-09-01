<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Resources\User;
use CCVShop\Api\Resources\UserCollection;
use CCVShop\Api\Resources\Webshop;

class Users extends BaseEndpoint implements Get, GetAll, Patch
{
    protected string $resourcePath = 'users';

    /**
     * @return User
     */
    protected function getResourceObject(): User
    {
        return new User($this->client);
    }

    /**
     * @return UserCollection
     */
    protected function getResourceCollectionObject(): UserCollection
    {
        return new UserCollection();
    }

    /**
     * @param int $id
     *
     * @return User
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): User
    {
        /** @var User */
        $result = $this->restGetOne($id, []);

        return $result;
    }

    /**
     * @param Webshop                        $webshop
     * @param array<string,int|float|string> $parameters
     *
     * @return UserCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getFor(Webshop $webshop, array $parameters = []): UserCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($webshop));

        /** @var UserCollection */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int                            $webshopId
     * @param array<string,int|float|string> $parameters
     *
     * @return UserCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getForId(int $webshopId, array $parameters = []): UserCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->webshops->getResourcePath(), $webshopId));

        /** @var UserCollection */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param User|null $user
     *
     * @return void
     *
     * @throws InvalidHashOnResult
     * @throws \JsonException
     * @throws InvalidResponseException
     */
    public function patch(?User $user = null): void
    {
        if ($user === null) {
            throw new \InvalidArgumentException(User::class . ' required');
        }
        $this->restPatch($user);
    }

    /**
     * @param array<string,int|float|string> $parameters
     *
     * @return UserCollection
     *
     * @throws InvalidHashOnResult
     * @throws \JsonException
     * @throws InvalidResponseException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): UserCollection
    {
        /** @var UserCollection */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }
}
