<?php

declare(strict_types=1);

namespace CCVShop\Api;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class BaseResource
{
    protected ApiClient $client;
    /** @var array<string> */
    public array $dates = [];
    /** @var array<string> */
    public array $entities = [];

    /**
     * @return BaseEndpoint
     */
    abstract public function getEndpoint(): BaseEndpoint;

    /**
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function getId(): int
    {
        if (property_exists($this, 'id')) {
            return $this->id;
        }
        throw new \InvalidArgumentException('Resource is asked for `id` but doesn\'t have this property. ');
    }
}
