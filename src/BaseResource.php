<?php
declare(strict_types=1);

namespace CCVShop\Api;

abstract class BaseResource
{
    protected ApiClient $client;
    public array $dates = [];

    public array $elementObjects = [];

    abstract public function getEndpoint(): BaseEndpoint;

    /**
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }
}
