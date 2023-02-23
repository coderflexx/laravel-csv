<?php

namespace Coderflex\LaravelCsv;

use Coderflex\LaravelCsv\Http\Livewire\CsvImporter;
use Coderflex\LaravelCsv\Http\Livewire\HandleImports;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
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
            ->hasAssets()
            ->hasViews('laravel-csv')
            ->hasMigration('create_csv_imports_table');
    }

    public function bootingPackage()
    {
        $this->registerLivewireComponents();

        $this->configureComponents();

        $this->registerBladeDirectives();
    }

    public function registeringPackage()
    {
        $this->app->bind('laravel-csv', fn () => new LaravelCsvManager);
    }

    /**
     * Configure Laravel CSV Blade components
     */
    protected function configureComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('button');
        });
    }

    /**
     * Register livewire components
     */
    protected function registerLivewireComponents(): void
    {
        /** @phpstan-ignore-next-line */
        Livewire::component('csv-importer', CsvImporter::class);

        /** @phpstan-ignore-next-line */
        Livewire::component('handle-imports', HandleImports::class);
    }

    /**
     * Register given component.
     */
    protected function registerComponent(string $component): void
    {
        Blade::component('laravel-csv::components.'.$component, 'csv-'.$component);
    }

    /**
     * Register laravel CSV blade directives
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        Blade::directive('csvStyles', [LaravelCsvDirectives::class, 'csvStyles']);
        Blade::directive('csvScripts', [LaravelCsvDirectives::class, 'csvScripts']);
    }
}
