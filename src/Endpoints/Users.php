<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Patch;
use CCVShop\Api\Resources\UserCollection;
use CCVShop\Api\Resources\User;
use CCVShop\Api\Resources\Webshop;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class Users extends BaseEndpoint implements
    Get,
    GetAll,
    Patch
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
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function get(int $id): User
    {
        /** @var User $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @param Webshop $webshop
     * @param array $parameters
     *
     * @return UserCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getFor(Webshop $webshop, array $parameters = []): UserCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($webshop));

        /** @var UserCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param int $webshopId
     * @param array $parameters
     *
     * @return UserCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getForId(int $webshopId, array $parameters = []): UserCollection
    {
        $this->setParent(ResourceFactory::createParent($this->client->webshops->getResourcePath(), $webshopId));

        /** @var UserCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param User|null $user
     * @return void
     * @throws InvalidHashOnResult
     * @throws JsonException
     * @throws InvalidResponseException
     */
    public function patch(User $user = null): void
    {
        if ($user === null) {
            throw new InvalidArgumentException(User::class . ' required');
        }
        $this->rest_patch($user->id, [
            'username'                     => $user->username,
            'group_id'                     => $user->group_id,
            'status'                       => $user->status,
            'approval_status'              => $user->approval_status,
            'product_in_category_discount' => $user->product_in_category_discount,
            'userinfo'                     => $user->userinfo,
        ]);
    }

    /**
     * @param array $parameters
     *
     * @return UserCollection
     * @throws InvalidHashOnResult
     * @throws JsonException
     * @throws InvalidResponseException
     * @throws ReflectionException
     */
    public function getAll(array $parameters = []): UserCollection
    {
        /** @var UserCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }
}
