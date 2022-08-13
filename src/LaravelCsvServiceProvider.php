<?php

namespace Coderflex\LaravelCsv;

use Coderflex\LaravelCsv\Commands\LaravelCsvCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCsvServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-csv')
            ->hasConfigFile('laravel_csv')
            ->hasViews('laravel-csv')
            ->hasMigration('create_laravel_csv_table')
            ->hasCommand(LaravelCsvCommand::class);
    }
}
