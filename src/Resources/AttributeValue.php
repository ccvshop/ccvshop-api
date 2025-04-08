<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\AttributeValues;

class AttributeValue extends BaseResource
{
    public ?int $id               = null;
    public ?int $attribute_id     = null;
    public ?string $name          = null;
    public ?string $default_price = null;
    public ?string $type          = null;


    /**
     * @return AttributeValues
     */
    public function getEndpoint(): AttributeValues
    {
        return $this->client->attributeValues;
    }
}
