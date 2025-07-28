<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Put;
use CCVShop\Api\Resources\User;
use CCVShop\Api\Resources\Creditpoint;
use CCVShop\Api\Resources\CreditpointCollection;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class CreditPoints extends BaseEndpoint implements
    Put
{
    protected string $resourcePath = 'creditpoints';

    protected ?string $parentResourcePath = 'users';

    /**
     * @return Creditpoint
     */
    protected function getResourceObject(): Creditpoint
    {
        return new Creditpoint($this->client);
    }

    /**
     * @return CreditpointCollection
     */
    protected function getResourceCollectionObject(): CreditpointCollection
    {
        return new CreditpointCollection();
    }

    /**
     * @description Get all product photos by product resource.
     * @param User $user
     * @param array $parameters
     * @return CreditpointCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function getFor(User $user, array $parameters = []): CreditpointCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($user));
        /** @var CreditpointCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param int $id
     * @param array $parameters
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function put(int $id, array $parameters = [])
    {
        if ($id === null) {
            throw new InvalidArgumentException('user id is required');
        }

        $parent = ResourceFactory::createParent($this->client->users->getResourcePath(), $id);
        $this->setParent($parent);
        $this->rest_put($parameters);
    }
}
