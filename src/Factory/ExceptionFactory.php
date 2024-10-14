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
            return new \CCVShop\Api\Exceptions\InvalidResponseException('InvalidResponseException, could not decode json response:' . "\n" . $json . "\n" . 'Exit with message:'. $e->getMessage());
        }
        switch ($exceptionData->code) {
            case '405.10':
                // Method Not Allowed
                $ex = new \CCVShop\Api\Exceptions\MethodNotAllowedException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.10':
                $ex = new \CCVShop\Api\Exceptions\UnknowRateLimitException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.20':
                $ex = new \CCVShop\Api\Exceptions\OutputSchemeMatchException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.21':
                $ex = new \CCVShop\Api\Exceptions\FileSizeExceededException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.22':
                $ex = new \CCVShop\Api\Exceptions\FileTypeNotValidException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.23':
                $ex = new \CCVShop\Api\Exceptions\FileNotSavedException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.24':
                $ex = new \CCVShop\Api\Exceptions\FileNotFoundException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.25':
                $ex = new \CCVShop\Api\Exceptions\JasonSchemaNotFoundException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.40':
                $ex = new \CCVShop\Api\Exceptions\PropertyAlreadyExistsException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.50':
                $ex = new \CCVShop\Api\Exceptions\SameValueException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.60':
                $ex = new \CCVShop\Api\Exceptions\ProductLimitExceededException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.70':
                $ex = new \CCVShop\Api\Exceptions\MethodNotAllowedOnResourceException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.80':
                $ex = new \CCVShop\Api\Exceptions\RequestedPayloadToBigException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '500.90':
                $ex = new \CCVShop\Api\Exceptions\RequiredAppNotInstalledException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '501.10':
                $ex = new \CCVShop\Api\Exceptions\MethodNotImplementedException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '501.20':
                $ex = new \CCVShop\Api\Exceptions\ResourceNotImplementedException($exceptionData->developermessage, $exceptionData->status);
                break;
            case '501.30':
                $ex = new \CCVShop\Api\Exceptions\ResourceReadonlyException($exceptionData->developermessage, $exceptionData->status);
                break;
            default:
                $ex = new \Exception($exceptionData->developermessage, $exceptionData->status);
                break;
        }

        return $ex;
    }
}
