<?php

declare(strict_types=1);

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Language;
use CCVShop\Api\Resources\LanguageCollection;
use GuzzleHttp\Exception\GuzzleException;

class Languages extends BaseEndpoint implements GetAll, Post
{
    protected string $resourcePath = 'languages';

    /**
     * @description Get the resource object
     *
     * @return Language
     */
    protected function getResourceObject(): Language
    {
        return new Language($this->client);
    }

    /**
     * @description Get the resource collection object
     *
     * @return LanguageCollection
     */
    protected function getResourceCollectionObject(): LanguageCollection
    {
        return new LanguageCollection();
    }

    /**
     * @description Get all by parameters
     *
     * @param array<string,int|float|string> $parameters
     *
     * @return LanguageCollection
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function getAll(array $parameters = []): LanguageCollection
    {
        /** @var LanguageCollection $result */
        $result = $this->restGetAll(null, null, $parameters);

        return $result;
    }

    /**
     * @param Language|null $language
     *
     * @return Language
     *
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function post(?Language $language = null): Language
    {
        if (is_null($language)) {
            throw new \InvalidArgumentException(Language::class . ' required');
        }

        /** @var Language $result */
        $result = $this->restPost($language);

        return $result;
    }
}
