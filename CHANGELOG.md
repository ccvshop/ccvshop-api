# Changelog CCV Shop API SDK

## [v1]

### Breaking Changes

- The following put() calls have been removed and replaced for a putFor(). This to describe the parent resource better.


| Removed                                             | In favor of                                    |
|-----------------------------------------------------|------------------------------------------------|
| `\CCVShop\Api\Endpoints\CreditPoints::put`          | `\CCVShop\Api\Endpoints\CreditPoints::putFor`  |
| `\CCVShop\Api\Endpoints\OrderLabels::put`           | `\CCVShop\Api\Endpoints\OrderLabels::putFor`   |
| `\CCVShop\Api\Endpoints\OrderLabels::putOrderLabel` | `\CCVShop\Api\Endpoints\OrderLabels::putFor`   |
| `\CCVShop\Api\Endpoints\ProductLabels::put`         | `\CCVShop\Api\Endpoints\ProductLabels::putFor` |
| `\CCVShop\Api\Endpoints\ProductPhotos::put`         | `\CCVShop\Api\Endpoints\ProductPhotos::putFor` |
