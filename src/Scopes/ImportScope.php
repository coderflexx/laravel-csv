<?php

namespace Coderflex\LaravelCsv\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ImportScope
{
    /**
     * Completed Status Scope
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted(Builder $builder): Builder
    {
        return $builder->whereNotNull('completed_at');
    }

    /**
     * Not Completed Status Scope
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotCompleted(Builder $builder): Builder
    {
        return $builder->whereNull('completed_at');
    }

    /**
     * Fetch imports based on the given model
     *
     * @param  string  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForModel(Builder $builder, string $model): Builder
    {
        return $builder->where('importable_type', $model);
    }
}
