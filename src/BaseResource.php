<?php
declare(strict_types=1);

namespace CCVShop\Api;

abstract class BaseResource
{
    protected ApiClient $client;
    protected array $dates = [];

    abstract public function getEndpoint(): BaseEndpoint;

    /**
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
    {
        $this->client = $client;

        foreach($this->dates as $property) {
            if (!empty($this->{$property})) {
                $this->{$property} = new \DateTime($this->{$property});
            }
        }
    }
}
