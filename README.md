<p align="center">
    <img src="art/logo.png" alt="Laravisit Logo" width="300">
    <br><br>
</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coderflexx/laravel-csv.svg?style=flat-square)](https://packagist.org/packages/coderflex/laravel-csv)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/coderflexx/laravel-csv/run-tests?label=tests)](https://github.com/coderflexx/laravel-csv/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/coderflexx/laravel-csv/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/coderflexx/laravel-csv/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/coderflexx/laravel-csv.svg?style=flat-square)](https://packagist.org/packages/coderflex/laravel-csv)


- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [CSV Importer Component](#csv-importer-component)
  - [Button Component](#button-component)
  - [In TALL stack project](#in-tall-stack-project)
  - [In none TALL Stack project](#in-none-tall-stack-project)
  - [Using Queues](#using-queues)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Inspiration](#inspiration)
- [Credits](#credits)
- [License](#license)

## Introduction
__Laravel CSV__ Package is a package created on top of Laravel [livewire](https://laravel-livewire.com) for easily handling imports with a simple API.

## Installation

You can install the package via composer:

```bash
composer require coderflex/laravel-csv
```

## Configuration

Publish and run the migrations with:

```bash
php artisan vendor:publish --tag="csv-migrations"
php artisan migrate
```

Publish the config file with:

```bash
php artisan vendor:publish --tag="csv-config"
```

The following is the contents of the published config file:

```php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Layout
    |--------------------------------------------------------------------------
    |
    | This package plans on supporting multiple CSS frameworks. 
    | Currently, 'tailwindcss' is the default and only supported framework.
    |
    */
    'layout' => 'tailwindcss',

    /*
    |--------------------------------------------------------------------------
    | Max Upload File Size
    |--------------------------------------------------------------------------
    |
    | The default maximumum file size that can be imported by this
    | package is 20MB. If you wish to increase/decrease this value, 
    | change the value in KB below.
    |
    */
    'file_upload_size' => 20000,
];
```

The `layout` option is for choosing which CSS framework you are using and currently supports only `tailwindcss`. We are working on other CSS frameworks to implement in the future.

The `file_upload_size` is for validation rules, and it defines the maximum file size of uploaded files. You may also define this value from the [livewire config](https://github.com/livewire/livewire/blob/master/config/livewire.php#L100) file.

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="csv-views"
```

> Before Using this command, please take a look at this [section](in-tall-stack-project) below.

## Usage

### CSV Importer Component
Using this package is a breeze. To implmenent the importer in your project, simply include the following component inside a Blade view.

```blade
    <livewire:csv-importer :model="App\Models\YourModel::class"
                            :columns-to-map="['id', 'name', 'email', 'password']"
                            :required-columns="['id', 'name', 'email']"
                            :columns-label="[
                                'id' => 'ID',
                                'name' => 'Name',
                                'email' => 'Email Address',
                                'password' => 'Password',
                            ]"/>
```

| Props  | Type  |  Description  |
|---|---|---|
|  model |`string` | Fully qualified name of the model you wish to import to  |
|  columns-to-map |`array` | Column names in the target database table |
|  required-columns |`array` | Columns that are required by validation for import  |
| columns-label  |`array` |  Display labels for the required columns  |

### Button Component
The Component uses `alpinejs` under the hood. To display an import button, include the `x-csv-button` component.

```blade
<x-csv-button>Import</x-csv-button>
```

To style the button, use the `class` attribute with Tailwind utility classes.

```blade
<x-csv-button 
        class="rounded py-2 px-3 bg-indigo-500 ..."
        type="button"
        ....>
    {{ __('Import') }}
</x-csv-button>
```
### In TALL stack project
If you are using this package in a [TALL Stack](https://tallstack.dev/) project, (Tailwindcss, Alpinejs, Laravel, Livewire) publish the vendor views to include Laravel-CSV in your project.

```bash
php artisan vendor:publish --tag="csv-views"
```
Then compile your assets.
```bash
npm run dev
```

### In none TALL Stack project
If you are not using the TALL Stack, use the `csv directives` to add the necessary styles/scripts.

```blade
<html>
    ...
    <head>
        ...
        @csvStyles
    </head>
        ...
    <footer>
        ...
        @csvScripts
    </footer>
</html>

```
### Using Queues
This package uses [queues](https://laravel.com/docs/9.x/queues#main-content) under the hood with [PHP Generators](https://www.php.net/manual/en/language.generators.overview.php) to make it fast and efficient.

Create the `batches table` by running
```bash
php artisan queue:batches-table
```
Then, run the migration.
```
php artisan migrate
```

After that, set up the queues' configuration.
Head to [Laravel Queues Documentation](https://laravel.com/docs/9.x/queues#main-content) to learn more.


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

## Inspiration
This Package Was Inspired by [codecourse](https://codecourse.com) video series. If you want to learn how this package was created, make sure to take a look at this [video series](https://codecourse.com/subjects/laravel-livewire)

## Credits

- [ousid](https://github.com/ousid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
