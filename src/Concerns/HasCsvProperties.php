<?php

namespace Coderflex\LaravelCsv\Concerns;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

/**
 * Coderflex\LaravelCsv\Concerns\HasCsvProperties
 *
 * @property Reader $readCsv
 * @property \League\Csv\TabularDataReader $csvRecords
 */
trait HasCsvProperties
{
    use InteractsWithCsvFiles;

    /**
     * Read CSV Property
     */
    public function getReadCsvProperty(): Reader
    {
        return $this->readCSV($this->file->getRealPath());
    }

    /**
     * Get CSV Records Property
     */
    public function getCsvRecordsProperty(): TabularDataReader
    {
        return Statement::create()->process($this->readCsv);
    }

    /**
     * Handle CSV Information properties from the given file
     */
    public function handleCsvProperties(): array|MessageBag
    {
        try {
            $fileHeaders = $this->readCsv->getHeader();
            $fileRowCount = $this->csvRecords->count();

            return [$fileHeaders, $fileRowCount];
        } catch (\League\Csv\SyntaxError $exception) {
            Log::warning($exception->getMessage());

            return $this->addError(
                'file',
                __('The file has error/errors, Please check, and try again')
            );
        }
    }
}
