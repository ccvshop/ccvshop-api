<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class AppPspPaymethod extends BaseResource implements PatchData, PostData
{
    public const CURRENCY_EUR = 'EUR';
    public const CURRENCY_CHF = 'CHF';
    public const CURRENCY_USD = 'USD';
    public const CURRENCY_GBP = 'GBP';
    public const CURRENCY_TRY = 'TRY';
    public const CURRENCY_CAD = 'CAD';
    public const CURRENCY_SRD = 'SRD';
    public const CURRENCY_DKK = 'DKK';
    public const CURRENCY_RON = 'RON';
    public const CURRENCY_SEK = 'SEK ';
    public const CURRENCIES = [
        self::CURRENCY_EUR,
        self::CURRENCY_CHF,
        self::CURRENCY_USD,
        self::CURRENCY_GBP,
        self::CURRENCY_TRY,
        self::CURRENCY_CAD,
        self::CURRENCY_SRD,
        self::CURRENCY_DKK,
        self::CURRENCY_RON,
        self::CURRENCY_SEK,
    ];

    public const REQUIRED_FIELD_FIRST_NAME = 'first_name';
    public const REQUIRED_FIELD_LAST_NAME = 'last_name';
    public const REQUIRED_FIELD_ADDRESS = 'address';
    public const REQUIRED_FIELD_GENDER = 'gender';
    public const REQUIRED_FIELD_MOBILE = 'mobile';
    public const REQUIRED_FIELD_BIRTHDATE = 'birthdate';
    public const REQUIRED_FIELD_COMPANY_NAME = 'company_name';
    public const REQUIRED_FIELD_CHAMBER_OF_COMMERCE_NUMBER = 'chamber_of_commerce_number';
    public const REQUIRED_FIELD_DELIVER_NAME = 'deliver_name';

    public const REQUIRED_FIELDS = [
        self::REQUIRED_FIELD_FIRST_NAME,
        self::REQUIRED_FIELD_LAST_NAME,
        self::REQUIRED_FIELD_ADDRESS,
        self::REQUIRED_FIELD_GENDER,
        self::REQUIRED_FIELD_MOBILE,
        self::REQUIRED_FIELD_BIRTHDATE,
        self::REQUIRED_FIELD_COMPANY_NAME,
        self::REQUIRED_FIELD_CHAMBER_OF_COMMERCE_NUMBER,
        self::REQUIRED_FIELD_DELIVER_NAME,
    ];

    // SONAR_IGNORE_START
    public ?int $resource_id = null;
    public ?string $id = null;
    public ?string $name = null;
    public ?string $icon = null;
    public ?string $type = null;
    /**
     * @var list<value-of<AppPspPaymethod::CURRENCIES>>
     */
    public array $currencies = [];
    /**
     * @var list<value-of<AppPspPaymethod::REQUIRED_FIELDS>>
     */
    public array $required_fields = [];
    // SONAR_IGNORE_END

    /**
     * @var list<string>
     */
    public array $issuers = [];

    public function getEndpoint(): BaseEndpoint
    {
        return $this->client->appPspPaymethods;
    }

    public function getPostData(): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'type' => $this->type,
            'currencies' => $this->currencies,
            'required_fields' => $this->required_fields,
            'issuers' => $this->issuers,
        ];

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }

    public function getPatchData(): array
    {
        return $this->getPostData();
    }

    public function getId(): int
    {
        return $this->resource_id;
    }
}
