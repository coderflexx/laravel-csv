<?php

namespace Coderflex\LaravelCsv\Concerns;

use League\Csv\Reader;

trait InteractsWithCsvFiles
{
    /**
     * Read CSV File.
     */
    protected function readCSV(string $path): Reader
    {
        $stream = fopen($path, 'r');
        $csv = Reader::createFromStream($stream);

        $csv->setHeaderOffset(0)
            ->skipEmptyRecords();

        return $csv;
    }
}
