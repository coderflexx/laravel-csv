<?php

use Coderflex\LaravelCsv\Http\Livewire\HandleImports;
use function Pest\Livewire\livewire;

it('renders handle imports component', function () {
    livewire(HandleImports::class)
        ->assertSuccessful();
});

it('renders handle imports component with model', function () {
    $model = Customer::class;

    livewire(HandleImports::class, [
        'model' => $model,
    ])
        ->assertSet('model', $model)
        ->assertSuccessful();
});
