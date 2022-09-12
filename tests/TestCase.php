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
            LivewireServiceProvider::class,
            LaravelCsvServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migrations = [
            include __DIR__.'/../database/migrations/create_csv_imports_table.php.stub',
            include __DIR__.'/Database/Migrations/create_customers_table.php',
            include __DIR__.'/Database/Migrations/create_users_table.php',
            include __DIR__.'/Database/Migrations/create_job_batches_table.php',
        ];

        collect($migrations)->each(fn ($path) => $path->up());
    }

    private function registerLivewireComponents():self
    {
        Livewire::component('csv-importer', CsvImporter::class);
        Livewire::component('handle-imports', HandleImports::class);

        return $this;
    }
}
