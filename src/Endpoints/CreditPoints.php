<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Factory\ResourceFactory;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\PutFor;
use CCVShop\Api\Resources\CreditPoint;
use CCVShop\Api\Resources\CreditPointCollection;
use CCVShop\Api\Resources\User;

class CreditPoints extends BaseEndpoint implements PutFor
{
    protected string $resourcePath = 'creditpoints';

    protected ?string $parentResourcePath = 'users';

    /**
     * @return CreditPoint
     */
    public function getResourceObject(): CreditPoint
    {
        return new CreditPoint($this->client);
    }

    /**
     * @return CreditPointCollection
     */
    public function getResourceCollectionObject(): CreditPointCollection
    {
        return new CreditPointCollection();
    }

    /**
     * @description Get all product photos by product resource.
     *
     * @param User                           $user
     * @param array<string,int|float|string> $parameters
     *
     * @return CreditPointCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws \JsonException|\ReflectionException
     */
    public function getFor(User $user, array $parameters = []): CreditPointCollection
    {
        $this->setParent(ResourceFactory::createParentFromResource($user));

        /** @var CreditPointCollection $result */
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

    public function putFor(?User $user = null, ?CreditPoint $creditPoint = null): void
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
