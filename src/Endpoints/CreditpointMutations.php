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
use CCVShop\Api\Resources\CreditpointMutation;
use CCVShop\Api\Resources\User;
use CCVShop\Api\Resources\Creditpoint;
use CCVShop\Api\Resources\CreditpointMutationCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class CreditpointMutations extends BaseEndpoint implements
    get
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
     * @param User $user
     * @param array $parameters
     * @return CreditpointMutationCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException|GuzzleException
	 */
    public function getFor(User $user, array $parameters = []): CreditpointMutationCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($user));
        /** @var CreditpointMutationCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param int $id
     *
     * @return CreditpointMutation
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function get(int $id): CreditpointMutation
    {
        /** @var CreditpointMutation $result */
        return $this->rest_getOne($id, []);
    }
}
