<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PatchData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class User extends BaseResource implements PatchData
{
    // SONAR_IGNORE_START
    // Ignore vanwege Sonar, maar noodzakelijk om de representatie van de API gelijk te houden
    public ?int $id = null;
    public ?string $href = null;
    public ?string $username = null;
    public ?int $group_id = null;
    public ?bool $status = null;
    public ?string $approval_status = null;
    public ?string $product_in_category_discount = null;
    public ?\stdClass $userinfo = null;

    // SONAR_IGNORE_END

    public function getEndpoint(): \CCVShop\Api\Endpoints\Users
    {
        return $this->client->users;
    }

    /**
     * @return array<string,string|int|bool|\stdClass|null>
     */
    public function getPatchData(): array
    {
        return [
            'username' => $this->username,
            'group_id' => $this->group_id,
            'status' => $this->status,
            'approval_status' => $this->approval_status,
            'product_in_category_discount' => $this->product_in_category_discount,
            'userinfo' => $this->userinfo,
        ];
    }
}
