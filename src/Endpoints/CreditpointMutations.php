<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Resources\Creditpoint;
use CCVShop\Api\Resources\CreditpointMutation;
use CCVShop\Api\Resources\CreditpointMutationCollection;
use CCVShop\Api\Resources\User;
use GuzzleHttp\Exception\GuzzleException;

class CreditpointMutations extends BaseEndpoint implements Get
{
    protected string $resourcePath = 'creditpointmutations';

    protected ?string $parentResourcePath = 'users';

    /**
     * @return Creditpoint
     */
    protected function getResourceObject(): Creditpoint
    {
        return new Creditpoint($this->client);
    }

    /**
     * @return CreditpointMutationCollection
     */
    protected function getResourceCollectionObject(): CreditpointMutationCollection
    {
        return new CreditpointMutationCollection();
    }

    /**
     * @description Get all product photos by product resource.
     *
     * @param User                           $user
     * @param array<string,int|float|string> $parameters
     *
     * @return CreditpointMutationCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException|GuzzleException
     */
    public function getFor(User $user, array $parameters = []): CreditpointMutationCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($user));

        /** @var CreditpointMutationCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param int $id
     *
     * @return CreditpointMutation
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function get(int $id): CreditpointMutation
    {
        /** @var CreditpointMutation $result */
        $result = $this->restGetOne($id, []);

        return $result;
    }
}
