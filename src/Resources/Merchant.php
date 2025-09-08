<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PatchData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Merchant extends BaseResource implements PatchData
{
    public ?int $id = null;
    public ?string $href = null;
    public ?string $uuid = null;
    public ?string $gender = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $full_name = null;
    public ?string $company = null;
    public ?string $email = null;
    public ?string $address_line = null;
    public ?string $street = null;
    public ?string $housenumber = null;
    public ?string $zipcode = null;
    public ?string $city = null;
    public ?string $country = null;
    public ?string $country_code = null;
    public ?string $telephone = null;
    public ?string $tax_number = null;
    public ?string $coc_number = null;
    public ?string $iban = null;
    public ?string $bank_account_holder_name = null;

    public function getWebshops(): WebshopCollection
    {
        return $this->client->webshops->getFor($this);
    }

    public function getEndpoint(): \CCVShop\Api\Endpoints\Merchant
    {
        return $this->client->merchant;
    }

    /**
     * @return array<string,string|int|bool|null>
     */
    public function getPatchData(): array
    {
        return [
            'uuid' => $this->uuid,
            'gender' => $this->gender,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company' => $this->company,
            'email' => $this->email,
            'street' => $this->street,
            'housenumber' => $this->housenumber,
            'zipcode' => $this->zipcode,
            'city' => $this->city,
            'country_code' => $this->country_code,
            'telephone' => $this->telephone,
            'coc_number' => $this->coc_number,
            'tax_number' => $this->tax_number,
            'iban' => $this->iban,
            'bank_account_holder_name' => $this->bank_account_holder_name,
        ];
    }
}
