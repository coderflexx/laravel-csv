<?php

namespace Coderflex\LaravelCsv\Concerns;

use League\Csv\Reader;
use League\Csv\ResultSet;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

trait HasCsvProperties
{
    use InteractsWithCsvFiles;

    /**
     * Read CSV Property
     *
     * @param  void
     * @return Reader
     */
    public function getReadCsvProperty(): Reader
    {
        return $this->readCSV($this->file->getRealPath());
    }

    /**
     * Get CSV Records Property
     *
     * @param  void
     * @return ResultSet
     */
    public function getCsvRecordsProperty(): ResultSet
    {
        return Statement::create()->process($this->readCsv);
    }
}
