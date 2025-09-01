<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\PutFor;
use CCVShop\Api\Resources\Creditpoint;
use CCVShop\Api\Resources\CreditpointCollection;
use CCVShop\Api\Resources\User;

class CreditPoints extends BaseEndpoint implements PutFor
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
     *
     * @param User                           $user
     * @param array<string,int|float|string> $parameters
     *
     * @return CreditpointCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(User $user, array $parameters = []): CreditpointCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($user));

        /** @var CreditpointCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @return void
     *
     * @deprecated
     * @see CreditPoints::putFor
     */
    public function put(): void
    {
        trigger_error('Use CreditPoints::putFor()', E_USER_ERROR);
    }

    public function putFor(?User $user = null, ?Creditpoint $creditPoint = null): void
    {
        if ($user === null) {
            throw new \InvalidArgumentException('Missing required parameter: User');
        }
        if ($creditPoint === null) {
            throw new \InvalidArgumentException('Missing required parameter: Creditpoint');
        }

        $parent = ResourceFactory::createParent($this->client->users->getResourcePath(), $user->id);
        $this->setParent($parent);
        $this->restPut($creditPoint);
    }
}
