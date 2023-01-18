# MultiversX SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/PeerMe/mx-sdk-laravel.svg?style=flat-square)](https://packagist.org/packages/PeerMe/mx-sdk-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/PeerMeHQ/mx-sdk-laravel/tests.yml?branch=main&label=Tests)](https://github.com/PeerMeHQ/mx-sdk-laravel/actions?query=workflow%3ATests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/PeerMe/mx-sdk-laravel.svg?style=flat-square)](https://packagist.org/packages/PeerMe/mx-sdk-laravel)

This SDK is a wrapper around the native [mx-sdk-php](https://github.com/PeerMeHQ/mx-sdk-php) to enable out-of-the-box support for [Laravel](https://laravel.com/) applications.

Additionally, it comes with pre-configured MultiversX API [Network Providers](https://github.com/PeerMeHQ/mx-sdk-php-network-providers) including caching mechanisms using the default Laravel cache driver.

## Installation

You can install the package via composer:

```bash
composer require peerme/mx-sdk-laravel
```

And publish the config file `config/multiversx.php` via

```bash
php artisan vendor:publish --provider="Peerme\MxLaravel\ServiceProvider" --tag="config"
```

## Usage

Since this package wraps & configures the native packages for Laravel, you can access their utitlies without further configurations.

This includes:
- User Login Signature Verification
- MultiversX constants
- Domain Objects
- Blockchain-specific constants
- Other Utitilies & more

For more details, please refer to their documentation:
- Core: [mx-sdk-php](https://github.com/PeerMeHQ/mx-sdk-php)
- Network Providers: [mx-sdk-php-network-providers](https://github.com/PeerMeHQ/mx-sdk-php-network-providers)

### Calling the API

When instantiating the Network Providers, you can decide to optionally cache responses:

```php
use Peerme\MxLaravel\Multiversx;

// retrieve fresh responses each time
$api = Multiversx::api();

// or retrieve cached responses subsequently for 1 hour
$api = Multiversx::apiWithCache(expiresAt: now()->addHour());
```
### Validation Rules

This package exposes the following Laravel [Validation Rules](https://laravel.com/docs/9.x/validation#available-validation-rules).

`MxAddressRule` – to validate a given address format:

```php
[
    'address' => ['required', new MxAddressRule],
]
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Micha Vie](https://github.com/michavie)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
