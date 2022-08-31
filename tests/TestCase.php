<?php

namespace Coderflex\LaravelCsv\Tests;

use Coderflex\LaravelCsv\Http\Livewire\CsvImporter;
use Coderflex\LaravelCsv\Http\Livewire\HandleImports;
use Coderflex\LaravelCsv\LaravelCsvServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Coderflex\\LaravelCsv\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->registerLivewireComponents();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelCsvServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_csv_imports_table.php.stub';
        $migration->up();

        $migration = include __DIR__.'/Database/Migrations/create_customers_table.php';
        $migration->up();
    }

    public function registerLivewireComponents()
    {
        Livewire::component(CsvImporter::class, 'csv-importer');
        Livewire::component(HandleImports::class, 'handle-imports');
    }
}
