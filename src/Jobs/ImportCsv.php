<?php

namespace Coderflex\LaravelCsv\Jobs;

use Coderflex\LaravelCsv\Models\Import;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Batchable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Import $import,
        public string $model,
        public array $chunk,
        public array $columns,
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $affectedRows = $this->model::upsert(
            $this->chunk,
            ['id'],
            collect($this->columns)->diff('id')->keys()->toArray(),
        );

        $this->import->increment('processed_rows', $affectedRows);
    }
}
