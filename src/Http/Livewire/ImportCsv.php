<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use Coderflex\LaravelCsv\Concerns;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCsv extends Component
{
    use WithFileUploads;
    use Concerns\InteractsWithColumns;
    use Concerns\InteractsWithFiles;
    use Concerns\HasCsvProperties;

    /** @var string */
    public string $model;

    /** @var $file */
    public $file;

    /** @var array */
    public array $columnsToMap = [];

    /** @var array */
    public array $requiredColumns = [];

    /** @var array */
    public array $columnLabels = [];

    /** @var array $fileHeaders */
    public array $fileHeaders = [];

    /** @var int $fileRowcount */
    public int $fileRowcount = 0;

    public function mount()
    {
        // map and coverts the columnsToMap property into an associative array
        $this->columnsToMap = $this->mapThroughColumns();

        // map and coverts the requiredColumns property int key => value array
        $this->columnLabels = $this->mapThroughColumnLabels();

        // map and coverts the requiredColumns property int key => required value
        $this->requiredColumns = $this->mapThroughRequiredColumns();
    }

    public function updatedFile()
    {
        $this->validateOnly('file');

        $this->updateFileHeaders();

        $this->updateFileRowcount();

        $this->resetValidation();
    }

    public function upload()
    {
        $this->updatedFile();
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
