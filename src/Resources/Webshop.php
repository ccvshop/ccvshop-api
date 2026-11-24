<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Webshops;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Webshop extends BaseResource
{
    // SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $id = null;
    public ?\DateTime $create_date = null;
    public ?string $name = null;
    public ?bool $is_multishop_system = null;
    public ?bool $is_salespos = null;
    public ?int $product_limit = null;
    public ?int $product_limit_left = null;
    public ?string $api_root = null;

    /** @var string[] */
    public array $dates = ['create_date'];

    // SONAR_IGNORE_END

    public function getEndpoint(): Webshops
    {
        return $this->client->webshops;
    }

    public function getMerchant(): MerchantCollection
    {
        return $this->client->merchant->getFor($this);
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return Credential
     *
     * @throws \CCVShop\Api\Exceptions\InvalidHashOnResult
     * @throws \CCVShop\Api\Exceptions\InvalidResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function postCredentials(array $data): Credential
    {
        $credential = new Credential($this->client);

        $credential->label = $data['label'] ?? null;
        $credential->api_public = $data['api_public'] ?? null;
        $credential->api_secret = $data['api_secret'] ?? null;
        $credential->link_to_main_user = $data['link_to_main_user'] ?? null;
        $credential->link_by_access_token = $data['link_by_access_token'] ?? null;
        $credential->permissions = $data['permissions'] ?? null;

        return $this->client->credentials->postFor($this, $credential);
    }
}
