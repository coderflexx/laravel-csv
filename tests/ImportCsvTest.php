<?php

use Coderflex\LaravelCsv\Http\Livewire\ImportCsv;
use Coderflex\LaravelCsv\Tests\Models\Customer;
use function Pest\Livewire\livewire;

it('renders import CSV component', function () {
    livewire(ImportCsv::class)
        ->assertSuccessful();
});

it('renders import CSV component with model', function () {
    $model = Customer::class;

    livewire(ImportCsv::class, [
        'model' => $model,
    ])
    ->assertSet('model', $model)
    ->assertSuccessful();
});

it('renders import CSV component with model and file', function () {
    $model = Customer::class;

    $file = __DIR__.'./Data/customers.csv';

    livewire(ImportCsv::class, [
        'model' => $model,
        'file' => $file,
    ])
    ->assertSet('model', $model)
    ->assertSet('file', $file)
    ->assertSuccessful();
});
