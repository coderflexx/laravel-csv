<?php

use Coderflex\LaravelCsv\Http\Livewire\ImportCsv;
use Coderflex\LaravelCsv\Tests\Models\Customer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Livewire\livewire;

it('renders import CSV component', function () {
    livewire(ImportCsv::class)
        ->assertSuccessful();
});

it('renders import CSV component with model', function () {
    $model = Customer::class;

    livewire(ImportCsv::class, [
        'model' => $model,
    ])
    ->assertSet('model', $model)
    ->assertSuccessful();
});

it('renders import CSV component with model and file', function () {
    $model = Customer::class;

    $file = __DIR__.'./Data/customers.csv';

    livewire(ImportCsv::class, [
        'model' => $model,
        'file' => $file,
    ])
    ->assertSet('model', $model)
    ->assertSet('file', $file)
    ->assertSuccessful();
});

it('transfers columnsToMap into an associative array', function () {
    $columnsToMap = [
        'name',
        'email',
        'phone',
    ];
    $model = Customer::class;
    $file = __DIR__.'./Data/customers.csv';

    livewire(ImportCsv::class, [
        'model' => $model,
        'file' => $file,
        'columnsToMap' => $columnsToMap,
    ])
    ->assertSet('model', $model)
    ->assertSet('file', $file)
    ->assertSet('columnsToMap', [
        'name' => '',
        'email' => '',
        'phone' => '',
    ])
    ->assertSuccessful();
});

it('maps requiredColumns property into columnsToMap required state', function () {
    $columnsToMap = [
        'name',
        'email',
        'phone',
    ];

    $requiredColumns = [
        'name',
        'email',
        'phone',
    ];
    $model = Customer::class;
    $file = __DIR__.'./Data/customers.csv';

    livewire(ImportCsv::class, [
        'model' => $model,
        'file' => $file,
        'columnsToMap' => $columnsToMap,
        'requiredColumns' => $requiredColumns,
    ])
    ->assertSet('model', $model)
    ->assertSet('file', $file)
    ->assertSet('requiredColumns', [
        'columnsToMap.name' => 'required',
        'columnsToMap.email' => 'required',
        'columnsToMap.phone' => 'required',
    ]);
});

it('maps through columnsLabels for validate attributes', function () {
    $columnsToMap = [
        'name', 'email', 'phone',
    ];

    $requiredColumns = [
        'name', 'email',
    ];

    $columnLabels = [
        'name' => 'Name',
        'email' => 'Email',
    ];

    $model = Customer::class;
    $file = __DIR__.'./Data/customers.csv';

    livewire(ImportCsv::class, [
        'model' => $model,
        'file' => $file,
        'columnsToMap' => $columnsToMap,
        'requiredColumns' => $requiredColumns,
        'columnLabels' => $columnLabels,
    ])
    ->assertSet('model', $model)
    ->assertSet('file', $file)
    ->assertSet('columnLabels', [
        'columnsToMap.name' => 'name',
        'columnsToMap.email' => 'email',
    ]);
});

it('returns csv headers & row counts when upload a file', function () {
    Storage::fake('documents');

    $file = UploadedFile::fake()
                    ->createWithContent(
                        'customers.csv',
                        file_get_contents('Data/customers.csv', true)
                    ); 

    $model = Customer::class;

    livewire(ImportCsv::class, [
        'model' => $model,
        'file' => $file,
    ])
    ->call('upload')
    // ->call('updateFileRowcount')
    ->assertSet('model', $model)
    ->assertSet('file', $file)
    ->assertSet('fileHeaders', [
        "id", "first_name", "last_name", "email", "company", "vip", "birthday", "created_at", "updated_at"
    ])
    ->assertSet('csvRowCount', 3);
});
