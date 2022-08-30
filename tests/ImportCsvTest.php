<?php

use Coderflex\LaravelCsv\Http\Livewire\ImportCsv;
use Coderflex\LaravelCsv\Models\Import;
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
    ])
    ->set('file', $file)
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
        'columnsToMap' => $columnsToMap,
    ])
    ->set('file', $file)
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
        'columnsToMap' => $columnsToMap,
        'requiredColumns' => $requiredColumns,
    ])
    ->set('file', $file)
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
        'columnsToMap' => $columnsToMap,
        'requiredColumns' => $requiredColumns,
        'columnLabels' => $columnLabels,
    ])
    ->set('file', $file)
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
    ])
    ->set('file', $file)
    ->assertSet('model', $model)
    ->assertSet('fileHeaders', [
        'id', 'first_name', 'last_name', 'email', 'company', 'vip', 'birthday', 'created_at', 'updated_at',
    ])
    ->assertSet('fileRowCount', 1000);
});

it('throws validation errors, if the file extension does not match', function () {
    Storage::fake('images');

    $file = UploadedFile::fake()->create('image.png');
    $model = Customer::class;

    livewire(ImportCsv::class, [
        'model' => $model,
    ])
    ->set('file', $file)
    ->assertHasErrors(['file']);
});

it('throws validation errors, if the columns does not match', function () {
    Storage::fake('documents');

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

    $file = UploadedFile::fake()
        ->createWithContent(
            'customers.csv',
            file_get_contents('Data/customers.csv', true)
        );

    $model = Customer::class;

    livewire(ImportCsv::class, [
        'model' => $model,
        'columnsToMap' => $columnsToMap,
        'requiredColumns' => $requiredColumns,
        'columnLabels' => $columnLabels,
    ])
    ->set('file', $file)
    ->call('import')
    ->assertHasErrors(['columnsToMap.name', 'columnsToMap.email']);
});

it('creates a new import records', function () {
    Storage::fake('documents');

    $file = UploadedFile::fake()
        ->createWithContent(
            'customers.csv',
            file_get_contents('Data/customers.csv', true)
        );

    $model = Customer::class;

    livewire(ImportCsv::class, [
        'model' => $model,
    ])
    ->set('file', $file)
    ->call('import')
    ->assertHasNoErrors();

    $this->assertEquals(Import::count(), 1);
    $this->assertEquals(Import::forModel(Customer::class)->count(), 1);
});
