<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCsv extends Component
{
    use WithFileUploads;

    /** @var string */
    public string $model;

    /** @var string */
    public string $file;

    /** @var array */
    public array $columnsToMap = [];

    /** @var array */
    public array $requiredColumns = [];

    /** @var array */
    public array $columnLabels = [];

    public function mount()
    {
        $this->columnsToMap = collect($this->columnsToMap)
                ->mapWithKeys(fn ($column): array => [$column => ''])
                ->toArray();

        if ($this->columnLabels) {
            $this->columnLabels = collect($this->requiredColumns)
                ->mapWithKeys(function ($column): array {
                    return [
                        'columnsToMap.'.$column => strtolower($this->columnLabels[$column]),
                    ];
                })->toArray();
        }

        $this->requiredColumns = collect($this->requiredColumns)
            ->mapWithKeys(function ($column): array {
                return ['columnsToMap.'.$column => 'required'];
            })->toArray();
    }

    public function render()
    {
        return view('laravel-csv::livewire.import-csv');
    }

    protected function rules()
    {
        return [
            'file' => 'required|file|mimes:csv,txt',
        ] + $this->requiredColumns;
    }

    protected function validationAttributes()
    {
        return $this->columnLabels;
    }
}
