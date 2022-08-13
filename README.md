
# A livewire CSV Importer, to handle importing millions of rows

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coderflex/laravel-csv.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-csv)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/coderflex/laravel-csv/run-tests?label=tests)](https://github.com/coderflexx/laravel-csv/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/coderflex/laravel-csv/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/coderflexx/laravel-csv/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/coderflex/laravel-csv.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-csv)

## Installation

You can install the package via composer:

```bash
composer require coderflex/laravel-csv
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-csv-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-csv-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-csv-views"
```

## Usage
...

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/ousid/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [ousid](https://github.com/ousid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
