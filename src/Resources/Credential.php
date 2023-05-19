<?php

namespace CCVShop\Api\Resources;

use Carbon\Carbon;
use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Resources\Call\Post;
use GuzzleHttp\Client;

class Credential extends BaseResource
{
	public ?string $href = null;
	public ?int $id = null;
	public ?string $createdate = null;
	public ?string $label = null;
	public ?string $api_public = null;
	public ?string $api_secret = null;
	public bool $link_to_main_user = false;
	public array $permissions = [];
}
