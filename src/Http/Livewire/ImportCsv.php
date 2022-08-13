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

    public function render()
    {
        return view('laravel-csv::livewire.import-csv');
    }
}
