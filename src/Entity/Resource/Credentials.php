<?php
declare(strict_types=1);

namespace CCVShop\Api\Entity\Resource;

class Credentials
{
	public ?string $href = null;
	public ?int $id = null;
	public ?string $createdate = null;
	public ?string $label = null;
	public ?string $api_public = null;
	public ?string $api_secret = null;
	public array $permissions = [];

	public static function createFromJson(string $json = null): self
	{
		$object = new self();

		if ($json === null) {
			return $object;
		}

		$data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);

		$object->href       = $data->href ?? null;
		$object->id         = $data->id ?? null;
		$object->createdate = $data->createdate ?? null;
		$object->label      = $data->label ?? null;
		$object->api_public = $data->api_public ?? null;
		$object->api_secret = $data->api_secret ?? null;

		return $object;
	}
}
