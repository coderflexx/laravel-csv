<?php

namespace Coderflex\LaravelCsv\Concerns;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

trait HasCsvProperties
{
    /**
     * Read CSV Property
     *
     * @param  void
     * @return Reader
     */
    public function getReadCsvProperty(): Reader
    {
        dd($this->file);

        return $this->readCSV($this->file->getRealPath());
    }

    /**
     * Get CSV Records Property
     *
     * @param  void
     * @return TabularDataReader
     */
    public function getCsvRecordsProperty(): TabularDataReader
    {
        return Statement::create()->process($this->readCsv);
    }

    /**
     * Update File Headers
     *
     * @param  void
     * @return array
     */
    public function updateFileHeaders(): array
    {
        $this->fileHeaders = $this->readCsv->getHeaders();

        return $this->fileHeaders;
    }

    /**
     * Update File Row Count
     *
     * @param  void
     * @return int
     */
    public function updateFileRowcount(): int
    {
        $this->fileRowCount = count($this->csvRecords);

        return $this->fileRowCount;
    }
}
