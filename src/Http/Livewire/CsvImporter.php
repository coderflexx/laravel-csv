<?php

namespace Coderflex\LaravelCsv\Http\Livewire;

use Coderflex\LaravelCsv\Concerns;
use Coderflex\LaravelCsv\Jobs\ImportCsv;
use Coderflex\LaravelCsv\Utilities\ChunkIterator;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Coderflex\LaravelCsv\csv_view_path;

class CsvImporter extends Component
{
    use WithFileUploads;
    use Concerns\InteractsWithColumns;
    use Concerns\HasCsvProperties;

    /** @var string */
    public $model;

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

    /** @var array */
    protected $exceptions = [
        'mode', 'columnsToMap', 'open',
        'columnLabels', 'requiredColumns',
    ];

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

        $this->setCsvProperties();

        $this->resetValidation();
    }

    public function import()
    {
        $this->validate();

        $this->importCsv();

        $this->resetExcept($this->exceptions);

        $this->emitTo('csv-imports', 'imports.refresh');
    }

    public function render()
    {
        return view(
            csv_view_path('csv-importer')
        );
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

    protected function setCsvProperties()
    {
        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                if ($this->handleCsvProperties() instanceof MessageBag) {
                    $validator->errors()->merge(
                        $this->handleCsvProperties()->getMessages()
                    );
                }
            });
        })->validate();

        [$this->fileHeaders, $this->fileRowCount] = $this->handleCsvProperties();
    }

    protected function importCsv()
    {
        $import = $this->createNewImport();
        $chunks = (new ChunkIterator($this->csvRecords->getIterator(), 10))->get();

        $jobs = collect($chunks)
                    ->map(
                        fn ($chunk) => new ImportCsv(
                            $import,
                            $this->model,
                            $chunk,
                            $this->columnsToMap
                        )
                    );

        Bus::batch($jobs)
                    ->name('import-csv')
                    ->finally(
                        fn () => $import->touch('compoleted_at')
                    )->dispatch();
    }

    protected function createNewImport()
    {
        /**
         * @var \Coderflex\LaravelCsv\Tests\Models\User */
        $user = auth()->user();

        return $user->imports()->create([
            'model' => $this->model,
            'file_path' => $this->file->getRealPath(),
            'file_name' => $this->file->getClientOriginalName(),
            'total_rows' => $this->fileRowCount,
        ]);
    }
}
