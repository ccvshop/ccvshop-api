<?php
declare(strict_types=1);

namespace CCVShop\Api\Entity\Collection;

class Webshops
{
	public ?string $href = null;
	public array $items = [];

	public static function createFromJson(string $json = null): self
	{
		$object = new self();

		if ($json === null) {
			return $object;
		}

		$data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);

		$object->href = $data->href;

		return $object;
	}
}
