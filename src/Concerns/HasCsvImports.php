<?php

namespace Coderflex\LaravelCsv\Concerns;

use Coderflex\LaravelCsv\Models\Import;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasCsvImports
{
    /**
     * Has imports relationshipt
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
   public function imports(): MorphMany
   {
        return $this->morphMany(Import::class, 'importable');
   }
}
