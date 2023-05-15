<?php

namespace CCVShop\Api\Factory;

use CCVShop\Api\BaseResource;

class ResourceFactory
{
	public static function createFromApiResult($apiResult, BaseResource $resource): BaseResource
	{
		foreach ($apiResult as $property => $value) {
			if (!property_exists($resource, $property)) {
				continue;
			}
			$resource->{$property} = $value;
		}

		return $resource;
	}
}
