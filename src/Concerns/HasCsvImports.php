<?php

namespace Coderflex\LaravelCsv\Concerns;

use Coderflex\LaravelCsv\Models\Import;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasCsvImports
{
    /**
     * Has imports relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Import>
     */
    public function imports(): HasMany
    {
        return $this->hasMany(Import::class, 'user_id');
    }
}
