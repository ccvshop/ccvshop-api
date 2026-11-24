<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\CreditPointMutation;
use CCVShop\Api\Resources\CreditPointMutationCollection;
use CCVShop\Api\Resources\User;
use GuzzleHttp\Exception\GuzzleException;

class CreditPointMutations extends BaseEndpoint implements Get
{
    protected string $resourcePath = 'creditpointmutations';

    protected ?string $parentResourcePath = 'users';

    /**
     * @return CreditPointMutation
     */
    public function getResourceObject(): CreditPointMutation
    {
        return new CreditPointMutation($this->client);
    }

    /**
     * @return CreditPointMutationCollection
     */
    public function getResourceCollectionObject(): CreditPointMutationCollection
    {
        return new CreditPointMutationCollection();
    }

    /**
     * @description Get all product photos by product resource.
     *
     * @param User                           $user
     * @param array<string,int|float|string> $parameters
     *
     * @return CreditPointMutationCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException|GuzzleException
     */
    public function getFor(User $user, array $parameters = []): CreditPointMutationCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($user));

        /** @var CreditPointMutationCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int $id
     *
     * @return CreditPointMutation
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): CreditPointMutation
    {
        /** @var CreditPointMutation $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }
}
