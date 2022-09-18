<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use function Coderflex\LaravelCsv\csv_view_path;
use Coderflex\LaravelCsv\Models\Import;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class HandleImports extends Component
{
    /** @var string */
    public $model;

    /** @var array */
    protected $listeners = [
        'imports.refresh' => '$refresh',
    ];

    public function mount(string $model): void
    {
        $this->model = $model;
    }

    public function getImportsProperty(): Collection
    {
        /** @var \Illuminate\Foundation\Auth\User */
        $user = auth()->user();

        return Import::query()
                    ->forModel($this->model)
                    ->forUser($user->id)
                    ->oldest()
                    ->unCompleted()
                    ->get();
    }

    public function render(): View|Factory
    {
        return view(
            csv_view_path('handle-imports')
        );
    }
}
