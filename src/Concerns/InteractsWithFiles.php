<?php

namespace Coderflex\LaravelCsv\Concerns;

use League\Csv\Reader;

trait InteractsWithFiles
{
    /**
     * Read CSV File.
     *
     * @param  string  $path
     * @return Reader
     */
    protected function readCSV(string $path): Reader
    {
        $stream = fopen($path, 'r');
        $csv = Reader::createFromStream($stream);

        $csv->setHeaderOffset(0);
        
        return $csv;
    }
    
}
