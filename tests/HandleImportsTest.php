<?php

use Coderflex\LaravelCsv\Http\Livewire\HandleImports;
use function Pest\Livewire\livewire;

it('renders handle imports component', function () {
    livewire(HandleImports::class)
        ->assertSuccessful();
});
