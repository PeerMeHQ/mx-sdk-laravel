# MultiversX SDK for Laravel

MultiversX SDK for Laravel (written in PHP).

This SDK is a wrapper around the native [mx-sdk-php](#) to enable out-of-the-box support for [Laravel](https://laravel.com/) applications.

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

TODO: add docs (constants, api, ipfs, utils, verify login)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Micha Vie](https://github.com/michavie)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
