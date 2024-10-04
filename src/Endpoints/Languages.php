<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Resources\Language;
use CCVShop\Api\Resources\LanguageCollection;

class Languages extends BaseEndpoint implements
    GetAll,
    Post
{
    protected string $resourcePath = 'languages';

    /**
     * @description Get the resource object
     * @return Language;
     */
    protected function getResourceObject(): Language
    {
        return new Language($this->client);
    }

    /**
     * @description Get the resource collection object
     * @return LanguageCollection
     */
    protected function getResourceCollectionObject(): LanguageCollection
    {
        return new LanguageCollection();
    }

    /**
     * @description Get all by parameters
     * @param array $parameters
     * @return LanguageCollection
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function getAll(array $parameters = []): LanguageCollection
    {
        /** @var LanguageCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param Language|null $language
     * @return Language
     * @throws InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function post(?Language $language = null): Language
    {
        if (is_null($language)) {
            throw new \InvalidArgumentException(Language::class . ' required');
        }

        /** @var Language */
        return $this->rest_post([
            'label' => $language->label,
            'base_language' => $language->base_language,
            'flag_icon' => $language->flag_icon,
        ]);
    }
}
