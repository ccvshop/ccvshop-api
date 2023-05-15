<?php

namespace CCVShop\Api\Factory;

class ExceptionFactory
{
	public static function createFromApiResult(string $json): \Exception
	{
		$exceptionData = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
		switch ($exceptionData->code) {
			case '500.24':
				// Internal Server Error - File NotFound. unknown resource id
				return new \CCVShop\Api\Exceptions\InternalServerErrorException($exceptionData->developermessage, $exceptionData->status);
			default:
				return new \Exception($exceptionData->developermessage, $exceptionData->status);
		}
	}
}
