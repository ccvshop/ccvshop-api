<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\Api\Interfaces\Resources\PostData;

class AppPsp extends BaseResource implements PostData, PatchData
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $description = null;
    public ?string $icon = null;
    public ?string $endpoint = null;
    /** @var AppPspPaymethod[]|\stdClass[] */
    public array $paymethods = [];

    public function getEndpoint(): BaseEndpoint
    {
        return $this->client->appPsp;
    }

    public function getPostData(): array
    {
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'icon' => $this->icon,
            'endpoint' => $this->endpoint,
            'paymethods' => [],
        ];

        foreach ($this->paymethods as $paymethod) {
            // If the object is a proper resource, we use the helper function.
            if ($paymethod instanceof PostData) {
                $data['paymethods'][] = $paymethod->getPostData();
            } else {
                $data['paymethods'][] = $paymethod;
            }
        }

        // Filter the array to remove entries with null values
        return array_filter($data, static function ($value) {
            return ! is_null($value);
        });
    }

    public function getPatchData(): array
    {
        return $this->getPostData();
    }
}
