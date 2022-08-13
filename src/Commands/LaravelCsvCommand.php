<?php

namespace Coderflex\LaravelCsv\Commands;

use Illuminate\Console\Command;

class LaravelCsvCommand extends Command
{
    public $signature = 'laravel-csv';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
