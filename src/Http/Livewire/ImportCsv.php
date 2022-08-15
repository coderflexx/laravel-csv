<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use Coderflex\LaravelCsv\Concerns\InteractsWithColumns;
use Livewire\Component;
use Livewire\WithFileUploads;
use Termwind\Components\Dd;

class ImportCsv extends Component
{
    use WithFileUploads;
    use InteractsWithColumns;

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
        $this->columnsToMap = $this->mapThroughColumns();
        
        $this->columnLabels = $this->mapThroughColumnLabels();

        $this->requiredColumns = $this->mapThroughRequiredColumns();
    }

    public function render()
    {
        return view('laravel-csv::livewire.import-csv');
    }

    protected function validationAttributes()
    {
        return $this->columnLabels;
    }

    protected function rules()
    {
        return [
            'file' => 'required|file|mimes:csv,txt',
        ] + $this->requiredColumns;
    }
}
