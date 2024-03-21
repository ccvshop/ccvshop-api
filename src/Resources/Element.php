<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Credentials;
use CCVShop\Api\Resources\Call\Post;
use GuzzleHttp\Client;

class Element extends BaseResource
{

    public ?string $name = null;
    public ?string $label = null; //TODO:: string|object {nl:'nl tekst', en: 'ENNGLISH'}
    public ?string $element_type = null;
    public ?string $value = null;
    public ?string $deeplink = null;
    public ?string $icon = null;

    public ?array $options = null; //TODO:: dit moet een optionscollection zijn, deze moet nog als resource aangemaakt worden.
    public ?string $action = null;

    public function getEndpoint(): Credentials
    {
        //TODO:: aanpassen
        return $this->client->credentials;
    }
}
