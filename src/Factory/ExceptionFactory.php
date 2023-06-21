<?php

namespace CCVShop\Api\Factory;

class ExceptionFactory
{
    /**
     * @param string $json
     *
     * @return \Exception
     */
    public static function createFromApiResult(string $json): \Exception
    {
        try {
            $exceptionData = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return new \CCVShop\Api\Exceptions\InvalidResponseException($e->getMessage());
        }
        switch ($exceptionData->code) {
            case '405.10':
                // Method Not Allowed
                $ex = new \CCVShop\Api\Exceptions\MethodNotAllowedException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.24':
                // Internal Server Error - File NotFound. unknown resource id
                $ex = new \CCVShop\Api\Exceptions\InternalServerErrorException($exceptionData->developermessage, $exceptionData->status);
                break;
            default:
                $ex = new \Exception($exceptionData->developermessage, $exceptionData->status);
                break;
        }

        return $ex;
    }
}
