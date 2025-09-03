<?php

use Coderflex\LaravelCsv\Utilities\ChunkIterator;
use Illuminate\Http\UploadedFile;
use League\Csv\Reader;
use League\Csv\Statement;

it('interate over a csv and returns the result as chunked collection', function () {
    $file = UploadedFile::fake()
        ->createWithContent(
            'customers.csv',
            file_get_contents('stubs/customers.csv', true)
        );

    $stream = fopen($file->getRealPath(), 'r');
    $csv = Reader::createFromStream($stream);

    $file = $csv->setHeaderOffset(0);

    $statement = Statement::create()->process($file);

    $chunks = (new ChunkIterator($statement->getIterator(), 10))->get();

    $result = collect($chunks);

    $this->assertEquals(count((array) $result->first()), 10);
    $this->assertEquals($result->keys()->count(), 10);
});
