<?php

namespace Coderflex\LaravelCsv\Concerns;

use Coderflex\LaravelCsv\Models\Import;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasCsvImports
{
    /**
     * Has imports relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<Import>
     */
    public function imports(): MorphMany
    {
        return $this->morphMany(Import::class, 'importable');
    }
}
