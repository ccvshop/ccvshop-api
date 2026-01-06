# Changelog CCV Shop API SDK

## [v0.3.1] - 2026-01-05

### Added
- Added support for the `page_title` and `short_description` fields in
\CCVShop\Api\Resources\Product::getPostData(), ensuring these values are included in Product `POST` and `PATCH` requests.

## [v0.3] - 2025-09-18

### Added
- A README.md file to help guide new users.
- \CCVShop\Api\Factory\ApiCredentialFactory can now be used to easy create credential objects
- \CCVShop\Api\Factory\ApiClientFactory::create() can be used to easy add a custom httpClient. Ideal to mock calls during tests.

## [v0.2] - 2025-09-17

### Added
- New resource apppsp
- New resource apppsppaymethods
- Each endpoint has a method `getResourceObject` and `getResourceCollectionObject` to create an empty resource object.

### Changed
- Upgraded dependencies

## [v0.1] – 2025-09-08

Initial public release of the CCV Shop API SDK.
This SDK provides PHP developers with a structured way to interact with the CCV Shop API.
It replaces the old `dev-master` builds and introduces several breaking changes.

### Breaking Changes

- Several `put()` methods have been removed in favor of `putFor()` to better describe parent resources.

| Removed                                             | In favor of                                    |
|-----------------------------------------------------|------------------------------------------------|
| `\CCVShop\Api\Endpoints\CreditPoints::put`          | `\CCVShop\Api\Endpoints\CreditPoints::putFor`  |
| `\CCVShop\Api\Endpoints\OrderLabels::put`           | `\CCVShop\Api\Endpoints\OrderLabels::putFor`   |
| `\CCVShop\Api\Endpoints\OrderLabels::putOrderLabel` | `\CCVShop\Api\Endpoints\OrderLabels::putFor`   |
| `\CCVShop\Api\Endpoints\ProductLabels::put`         | `\CCVShop\Api\Endpoints\ProductLabels::putFor` |
| `\CCVShop\Api\Endpoints\ProductPhotos::put`         | `\CCVShop\Api\Endpoints\ProductPhotos::putFor` |

### Added

- First tagged release on [Packagist](https://packagist.org/).
- Basic endpoint coverage for common resources:
    - Orders
    - Products
    - Customers
    - Webshops
- Helper methods for authentication and making requests against the CCV Shop API.
- Consistent exception handling for failed API requests.

### Changed

- API calls now return structured models instead of raw arrays where possible.
- Standardized method names across endpoints to be more consistent (`getAll`, `getById`, `post`, `putFor`, `delete`).

### Deprecated

- Use of the `dev-master` build is no longer recommended.
- Old `put()` signatures are fully removed in favor of `putFor()`.
