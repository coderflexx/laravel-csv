<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use function Coderflex\LaravelCsv\csv_view_path;
use Coderflex\LaravelCsv\Models\Import;
use Livewire\Component;

class HandleImports extends Component
{
    /** @var string */
    protected $model;

    /** @var array */
    protected $listeners = [
        'imports.refresh' => '$refresh',
    ];

    public function mount(string $model)
    {
        $this->model = $model;
    }

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
        return view(
            csv_view_path('handle-imports')
        );
    }
}
