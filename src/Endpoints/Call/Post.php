<?php

namespace CCVShop\Api\Endpoints\Call;

interface Post
{
	public function Post(int $parentId, array $data);
}
