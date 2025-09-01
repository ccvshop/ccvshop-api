<?php

declare(strict_types=1);

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

class ExceptionFactory
{
    private const CODE_TO_EXCEPTION = [
        '404.20' => InvalidResourceNameException::class,
        // Method Not Allowed
        '405.10' => MethodNotAllowedException::class,
        // Method Not Allowed
        '429.10' => RateLimitResourceException::class,
        // Each method in each resource has a limit of requests that can be made per minute. Please lower the frequency of your request rate.
        '429.11' => RateLimitTotalException::class,
        // The API has a total limit of requests that can be made per minute. Please lower the frequency of your request rate.
        '500.10' => UnknowRateLimitException::class,
        '500.20' => OutputSchemeMatchException::class,
        '500.21' => FileSizeExceededException::class,
        '500.22' => FileTypeNotValidException::class,
        '500.23' => FileNotSavedException::class,
        '500.24' => FileNotFoundException::class,
        '500.25' => JasonSchemaNotFoundException::class,
        '500.40' => PropertyAlreadyExistsException::class,
        '500.50' => SameValueException::class,
        '500.60' => ProductLimitExceededException::class,
        '500.70' => MethodNotAllowedOnResourceException::class,
        '500.80' => RequestedPayloadToBigException::class,
        '500.90' => RequiredAppNotInstalledException::class,
        '501.10' => MethodNotImplementedException::class,
        '501.20' => ResourceNotImplementedException::class,
        '501.30' => ResourceReadonlyException::class,
    ];

    /**
     * @param string      $json
     * @param string|null $trace
     * @param string|null $uri
     * @param string|null $method
     *
     * @return \Exception
     */
    public static function createFromApiResult(string $json, ?string $trace = '', ?string $uri = '', ?string $method = ''): \Exception
    {
        try {
            $exceptionData = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
            $message = self::getMessage($exceptionData, $trace, $uri, $method);
        } catch (\JsonException $e) {
            return new InvalidResponseException('InvalidResponseException, could not decode json response:' . "\n" . $json . "\n" . 'Exit with message:' . $e->getMessage());
        }

        if (! isset($exceptionData->code)) {
            // In case something goes wrong that is not in the correct format that the API should deliver.
            if (! isset($exceptionData->status)) {
                $exceptionData->status = 500;
            }

            return new \Exception($message, $exceptionData->status);
        }

        return self::getException($exceptionData, $message);
    }

    /**
     * @param \stdClass   $exceptionData
     * @param string|null $trace
     * @param string|null $uri
     * @param string|null $method
     *
     * @return string
     *
     * @throws \JsonException
     */
    private static function getMessage(\stdClass $exceptionData, ?string $trace = '', ?string $uri = '', ?string $method = ''): string
    {
        $message = 'Call to:' . ($uri ?? 'unknown_uri') . ' got an exception' . PHP_EOL
            . 'Method used:' . ($method ?? 'unknown_method') . PHP_EOL
            . ($exceptionData->developermessage ?? '-NO DEVELOPER MESSAGE SET-') . PHP_EOL
            . ($trace ?? 'no_trace');

        if (! isset($exceptionData->code)) {
            $message .= 'Raw exception data: ' . json_encode($exceptionData, JSON_THROW_ON_ERROR);
        }

        return $message;
    }

    /**
     * @param \stdClass $exceptionData
     * @param string    $message
     *
     * @return \Exception
     */
    private static function getException(\stdClass $exceptionData, string $message): \Exception
    {
        if (! isset(self::CODE_TO_EXCEPTION[$exceptionData->code])) {
            return new \Exception($message, $exceptionData->status);
        }

        $exceptionName = self::CODE_TO_EXCEPTION[$exceptionData->code];

        return new $exceptionName($message, $exceptionData->status);
    }
}
