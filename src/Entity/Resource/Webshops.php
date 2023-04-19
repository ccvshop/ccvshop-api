<?php
declare(strict_types=1);

namespace CCVShop\Api\Entity\Resource;

class Webshops
{
	public ?string $href = null;
	public ?int $id = null;
	public ?string $name = null;
	public ?bool $is_multishop_system = null;
	public ?int $product_limit = null;
	public ?int $product_limit_left = null;
	public ?string $api_root = null;

	public static function createFromJson(string $json = null): self
	{
		$object = new self();

		if ($json === null) {
			return $object;
		}

		$data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);

		$object->href                = $data->href;
		$object->id                  = $data->id;
		$object->name                = $data->name;
		$object->is_multishop_system = $data->is_multishop_system;
		$object->product_limit       = $data->product_limit;
		$object->product_limit_left  = $data->product_limit_left;
		$object->api_root            = $data->api_root;

		return $object;
	}
}
