<?php

use Coderflex\LaravelCsv\Http\Livewire\HandleImports;
use Coderflex\LaravelCsv\Tests\Models\User;
use function Pest\Livewire\livewire;

it('renders handle imports component with model', function () {
    $this->actingAs(User::factory()->create());

    $model = Customer::class;

    livewire(HandleImports::class, [
        'model' => $model,
    ])
        ->assertSet('model', $model)
        ->assertSuccessful();
});
