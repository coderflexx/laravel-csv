<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use Coderflex\LaravelCsv\Concerns;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCsv extends Component
{
    use WithFileUploads;
    use Concerns\InteractsWithColumns;
    use Concerns\HasCsvProperties;

    /** @var string */
    public string $model;

    /** @var object */
    public $file;

    /** @var array */
    public array $columnsToMap = [];

    /** @var array */
    public array $requiredColumns = [];

    /** @var array */
    public array $columnLabels = [];

    /** @var array */
    public array $fileHeaders = [];

    /** @var int */
    public int $fileRowCount = 0;

    public function mount()
    {
        // map and coverts the columnsToMap property into an associative array
        $this->columnsToMap = $this->mapThroughColumns();

        // map and coverts the requiredColumns property int key => value array
        $this->columnLabels = $this->mapThroughColumnLabels();

        // map and coverts the requiredColumns property int key => required value
        // $this->requiredColumns = $this->mapThroughRequiredColumns();
    }

    public function updatedFile()
    {
        $this->validateOnly('file');

        $this->fileHeaders = $this->readCsv->getHeader();
        $this->fileRowCount = count($this->csvRecords);

        $this->resetValidation();
    }

    public function import()
    {
        $this->validate();

        $import = $this->createNewImport();
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
        ] + $this->mapThroughRequiredColumns();
    }

    protected function createNewImport()
    {
        return (new $this->model)->imports()->create([
            'user_id' => auth()->id() ?? null,
            'file_path' => $this->file->getRealPath(),
            'file_name' => $this->file->getClientOriginalName(),
            'total_rows' => $this->fileRowCount,
        ]);
    }
}
