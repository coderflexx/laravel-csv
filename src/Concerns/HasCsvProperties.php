<?php

namespace Coderflex\LaravelCsv\Concerns;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

/**
 * Coderflex\LaravelCsv\Concerns\HasCsvProperties
 *
 * @property Reader $readCsv
 * @property array $csvRecords
 */
trait HasCsvProperties
{
    use InteractsWithCsvFiles;

    /**
     * Read CSV Property
     *
     * @return Reader
     */
    public function getReadCsvProperty(): Reader
    {
        return $this->readCSV($this->file->getRealPath());
    }

    /**
     * Get CSV Records Property
     *
     * @return TabularDataReader
     */
    public function getCsvRecordsProperty(): TabularDataReader
    {
        return Statement::create()->process($this->readCsv);
    }
}
