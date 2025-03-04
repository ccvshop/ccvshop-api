<?php

namespace CCVShop\Api\Factory;

use CCVShop\Api\Exceptions\FileNotFoundException;
use CCVShop\Api\Exceptions\FileNotSavedException;
use CCVShop\Api\Exceptions\FileSizeExceededException;
use CCVShop\Api\Exceptions\FileTypeNotValidException;
use CCVShop\Api\Exceptions\InvalidResourceNameException;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Exceptions\JasonSchemaNotFoundException;
use CCVShop\Api\Exceptions\MethodNotAllowedException;
use CCVShop\Api\Exceptions\MethodNotAllowedOnResourceException;
use CCVShop\Api\Exceptions\MethodNotImplementedException;
use CCVShop\Api\Exceptions\OutputSchemeMatchException;
use CCVShop\Api\Exceptions\ProductLimitExceededException;
use CCVShop\Api\Exceptions\PropertyAlreadyExistsException;
use CCVShop\Api\Exceptions\RateLimitResourceException;
use CCVShop\Api\Exceptions\RateLimitTotalException;
use CCVShop\Api\Exceptions\RequestedPayloadToBigException;
use CCVShop\Api\Exceptions\RequiredAppNotInstalledException;
use CCVShop\Api\Exceptions\ResourceNotImplementedException;
use CCVShop\Api\Exceptions\ResourceReadonlyException;
use CCVShop\Api\Exceptions\SameValueException;
use CCVShop\Api\Exceptions\UnknowRateLimitException;
use Exception;
use JsonException;

class ExceptionFactory
{
    /**
     * @param string $json
     * @param string|null $trace
     * @param string|null $uri
     * @param string|null $method
     * @return Exception
     */
    public static function createFromApiResult(string $json, ?string $trace = '', ?string $uri = '', ?string $method = ''): Exception
    {
        try {
            $exceptionData = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return new InvalidResponseException('InvalidResponseException, could not decode json response:' . "\n" . $json . "\n" . 'Exit with message:' . $e->getMessage());
        }

        $message =
            'Call to:' . ($uri ?? 'unknown_uri') . ' got an exception' . "\n\n\t" .
            'Method used:' . ($method ?? 'unknown_method') . "\n\n" .
            ($exceptionData->developermessage ?? '-NO DEVELOPER MESSAGE SET-') . "\n\n" .
            $trace ?? 'no_trace';

        if(!isset($exceptionData->code)) {
            // In case something goes wrong that is not in the correct format that the API should deliver.
            return new Exception($message, $exceptionData->status ?? var_export($exceptionData, true));
        }

        switch ($exceptionData->code) {
            case '404.20':
                // Method Not Allowed
                $ex = new InvalidResourceNameException($message, $exceptionData->status);
                break;
            case '405.10':
                // Method Not Allowed
                $ex = new MethodNotAllowedException($message, $exceptionData->status);
                break;
            case '429.10':
                // Each method in each resource has a limit of of requests that can be made per minute. Please lower the frequency of your request rate.
                $ex = new RateLimitResourceException($message, $exceptionData->status);
                break;
            case '429.11':
                // The API has a total limit of requests that can be made per minute. Please lower the frequency of your request rate.
                $ex = new RateLimitTotalException($message, $exceptionData->status);
                break;
            case '500.10':
                $ex = new UnknowRateLimitException($message, $exceptionData->status);
                break;
            case '500.20':
                $ex = new OutputSchemeMatchException($message, $exceptionData->status);
                break;
            case '500.21':
                $ex = new FileSizeExceededException($message, $exceptionData->status);
                break;
            case '500.22':
                $ex = new FileTypeNotValidException($message, $exceptionData->status);
                break;
            case '500.23':
                $ex = new FileNotSavedException($message, $exceptionData->status);
                break;
            case '500.24':
                $ex = new FileNotFoundException($message, $exceptionData->status);
                break;
            case '500.25':
                $ex = new JasonSchemaNotFoundException($message, $exceptionData->status);
                break;
            case '500.40':
                $ex = new PropertyAlreadyExistsException($message, $exceptionData->status);
                break;
            case '500.50':
                $ex = new SameValueException($message, $exceptionData->status);
                break;
            case '500.60':
                $ex = new ProductLimitExceededException($message, $exceptionData->status);
                break;
            case '500.70':
                $ex = new MethodNotAllowedOnResourceException($message, $exceptionData->status);
                break;
            case '500.80':
                $ex = new RequestedPayloadToBigException($message, $exceptionData->status);
                break;
            case '500.90':
                $ex = new RequiredAppNotInstalledException($message, $exceptionData->status);
                break;
            case '501.10':
                $ex = new MethodNotImplementedException($message, $exceptionData->status);
                break;
            case '501.20':
                $ex = new ResourceNotImplementedException($message, $exceptionData->status);
                break;
            case '501.30':
                $ex = new ResourceReadonlyException($message, $exceptionData->status);
                break;
            default:
                $ex = new Exception($message, $exceptionData->status);
                break;
        }

        return $ex;
    }
}
