# CCV Shop API SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ccvshop/ccvshop-api-sdk.svg)](https://packagist.org/packages/ccvshop/ccvshop-api-sdk)
[![License](https://img.shields.io/packagist/l/ccvshop/ccvshop-api-sdk.svg)](LICENSE)

A PHP SDK for the [CCV Shop API](https://api.biedmeer.nl/API/Docs).
This package provides developers with a structured and consistent way to interact with the CCV Shop platform.

---

## Installation

Install via [Composer](https://getcomposer.org/):

```bash
composer require ccvshop/ccvshop-api-sdk
```

---

## Getting Started

You can initialize the SDK in two ways:

### 1. Using the Factory (recommended)

```php
<?php

use CCVShop\Api\ApiCredentials;
use CCVShop\Api\ApiClientFactory;

require __DIR__ . '/vendor/autoload.php';

$credentials = new ApiCredentials(
    'yourshop.ccvshop.nl',
    'your_api_public',
    'your_api_secret'
);

$client = ApiClientFactory::create($credentials);

// Example: fetch all orders
$orders = $client->orders->getAll();

foreach ($orders as $order) {
    echo $order->id . ' - ' . $order->orderNumber . PHP_EOL;
}
```

Optionally, you can inject your own **PSR-18 HTTP client** (for example a mocked Guzzle client in tests):

```php
use GuzzleHttp\Client as GuzzleClient;

$customHttpClient = new GuzzleClient();
$client = ApiClientFactory::create($credentials, $customHttpClient);
```

---

### 2. Direct Instantiation (backwards-compatible)

```php
<?php

use CCVShop\Api\ApiClient;

require __DIR__ . '/vendor/autoload.php';

$client = new ApiClient(
    'yourshop.ccvshop.nl',
    'your_api_public',
    'your_api_secret'
);

$product = $client->products->getOne(1);

echo $product->id . ' - ' . $product->name;
```

---

## Features

- Strongly typed models for common resources (Orders, Products, Customers, Webshops, etc.)
- Consistent method naming across endpoints (`getAll`, `getOne`, `post`, `putFor`, `delete`)
- Exception handling for failed requests
- Factory support for clean dependency injection
- Optional injection of your own PSR-18 HTTP client
- Easy resource object creation with `getResourceObject` and `getResourceCollectionObject`

---

## Documentation

- 📘 **API Reference**: [CCV Shop API Docs](https://api.biedmeer.nl/API/Docs)
- 📑 **Changelog**: [CHANGELOG.md](./CHANGELOG.md)

---

## Versioning

This SDK follows [Semantic Versioning](https://semver.org/).
Breaking changes will be documented in the [CHANGELOG](./CHANGELOG.md).

---

## Contributing

Contributions are welcome! Please open issues or submit pull requests for improvements and bug fixes.

---

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
