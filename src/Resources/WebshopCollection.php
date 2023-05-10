<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseCollection;
use CCVShop\Api\BaseResource;

class WebshopCollection extends BaseCollection
{
	/**
	 * @return string
	 */
	public function getCollectionResourceName()
	{
		return 'webshops';
	}


}
