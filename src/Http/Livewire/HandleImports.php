<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use Coderflex\LaravelCsv\Models\Import;
use Livewire\Component;

class HandleImports extends Component
{
    /** @var string */
    public $model;

    /** @var array */
    protected $listeners = [
        'imports.refresh' => '$refresh',
    ];

    public function getImportsProperty()
    {
        /** @var \Illuminate\Foundation\Auth\User */
        $user = auth()->user();

        return Import::query()
                    ->forModel($this->model)
                    ->forUser($user)
                    ->oldest()
                    ->notCompleted()
                    ->get();
    }

    public function render()
    {
        return view('laravel-csv::livewire.handle-imports');
    }
}
