<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Credentials;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Credential extends BaseResource implements PostData
{
    // SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $id = null;
    public ?\DateTime $createdate = null;
    public ?string $label = null;
    public ?string $api_public = null;
    public ?string $api_secret = null;
    public bool $link_to_main_user = false;
    public bool $link_by_access_token = false;
    /** @var array<int,object> */
    public array $permissions = [];
    // SONAR_IGNORE_END

    /** @var array<int,string> * */
    public array $dates = ['createdate'];

    public function getEndpoint(): Credentials
    {
        return $this->client->credentials;
    }

    /**
     * @return array<string, array<int, object>|bool|string|null>
     */
    public function getPostData(): array
    {
        return [
            'label' => $this->label,
            'api_public' => $this->api_public,
            'api_secret' => $this->api_secret,
            'link_to_main_user' => $this->link_to_main_user,
            'link_by_access_token' => $this->link_by_access_token,
            'permissions' => $this->permissions,
        ];
    }
}
