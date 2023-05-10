<?php

namespace CCVShop\Api;

abstract class BaseCollection extends \ArrayObject
{
	abstract public function getCollectionResourceName();
}
