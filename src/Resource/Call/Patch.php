<?php

namespace CCVShop\Api\Resource\Call;

interface Patch
{
	public function Patch(int $resourceId, array $data);
}
