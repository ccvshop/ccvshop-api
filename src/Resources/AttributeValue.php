<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\AttributeValues;

class AttributeValue extends BaseResource
{
    //SONAR_IGNORE_START
    // This needs to be ignored to match the API structure exactly.
    public ?int $id               = null;

    public ?int $attribute_id     = null;

    public ?string $name          = null;

    public ?string $default_price = null;

    public ?string $type          = null;
    //SONAR_IGNORE_END

    /**
     * @return AttributeValues
     */
    public function getEndpoint(): AttributeValues
    {
        return $this->client->attributeValues;
    }
}
