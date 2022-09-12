<?php

namespace Coderflex\LaravelCsv;

use Coderflex\LaravelCsv\Commands\LaravelCsvCommand;
use Coderflex\LaravelCsv\Http\Livewire\CsvImporter;
use Coderflex\LaravelCsv\Http\Livewire\HandleImports;
use Livewire\Livewire;
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

    public function bootingPackage()
    {
        $this->registerLivewireComponents();
    }

    private function registerLivewireComponents()
    {
        Livewire::component('csv-importer', CsvImporter::class);
        Livewire::component('handle-imports', HandleImports::class);
    }
}
