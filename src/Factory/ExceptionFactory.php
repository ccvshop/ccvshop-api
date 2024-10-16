<?php

namespace CCVShop\Api\Factory;

class ExceptionFactory
{
    /**
     * @param string $json
     *
     * @return \Exception
     */
    public static function createFromApiResult(string $json, ?string $trace = '', ?string $uri = '', ?string $method = ''): \Exception
    {
        try {
            $exceptionData = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return new \CCVShop\Api\Exceptions\InvalidResponseException('InvalidResponseException, could not decode json response:' . "\n" . $json . "\n" . 'Exit with message:' . $e->getMessage());
        }

        $message =
            'Call to:' . ($uri ?? 'unknown_uri') . ' got an exception' . "\n\n\t" .
            'Method used:' . ($method ?? 'unknown_method') . "\n\n" .
            $exceptionData->developermessage . "\n\n" .
            $trace ?? 'no_trace';

        switch ($exceptionData->code) {
            case '404.20':
                // Method Not Allowed
                $ex = new \CCVShop\Api\Exceptions\InvalidResourceNameException($message, $exceptionData->status);
                break;
            case '405.10':
                // Method Not Allowed
                $ex = new \CCVShop\Api\Exceptions\MethodNotAllowedException($message, $exceptionData->status);
                break;
            case '500.10':
                $ex = new \CCVShop\Api\Exceptions\UnknowRateLimitException($message, $exceptionData->status);
                break;
            case '500.20':
                $ex = new \CCVShop\Api\Exceptions\OutputSchemeMatchException($message, $exceptionData->status);
                break;
            case '500.21':
                $ex = new \CCVShop\Api\Exceptions\FileSizeExceededException($message, $exceptionData->status);
                break;
            case '500.22':
                $ex = new \CCVShop\Api\Exceptions\FileTypeNotValidException($message, $exceptionData->status);
                break;
            case '500.23':
                $ex = new \CCVShop\Api\Exceptions\FileNotSavedException($message, $exceptionData->status);
                break;
            case '500.24':
                $ex = new \CCVShop\Api\Exceptions\FileNotFoundException($message, $exceptionData->status);
                break;
            case '500.25':
                $ex = new \CCVShop\Api\Exceptions\JasonSchemaNotFoundException($message, $exceptionData->status);
                break;
            case '500.40':
                $ex = new \CCVShop\Api\Exceptions\PropertyAlreadyExistsException($message, $exceptionData->status);
                break;
            case '500.50':
                $ex = new \CCVShop\Api\Exceptions\SameValueException($message, $exceptionData->status);
                break;
            case '500.60':
                $ex = new \CCVShop\Api\Exceptions\ProductLimitExceededException($message, $exceptionData->status);
                break;
            case '500.70':
                $ex = new \CCVShop\Api\Exceptions\MethodNotAllowedOnResourceException($message, $exceptionData->status);
                break;
            case '500.80':
                $ex = new \CCVShop\Api\Exceptions\RequestedPayloadToBigException($message, $exceptionData->status);
                break;
            case '500.90':
                $ex = new \CCVShop\Api\Exceptions\RequiredAppNotInstalledException($message, $exceptionData->status);
                break;
            case '501.10':
                $ex = new \CCVShop\Api\Exceptions\MethodNotImplementedException($message, $exceptionData->status);
                break;
            case '501.20':
                $ex = new \CCVShop\Api\Exceptions\ResourceNotImplementedException($message, $exceptionData->status);
                break;
            case '501.30':
                $ex = new \CCVShop\Api\Exceptions\ResourceReadonlyException($message, $exceptionData->status);
                break;
            default:
                $ex = new \Exception($message, $exceptionData->status);
                break;
        }

        return $ex;
    }
}
