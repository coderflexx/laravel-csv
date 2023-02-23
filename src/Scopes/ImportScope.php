<?php

namespace Coderflex\LaravelCsv\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User;

trait ImportScope
{
    /**
     * Completed Status Scope
     */
    public function scopeCompleted(Builder $builder): Builder
    {
        return $builder->whereNotNull('completed_at');
    }

    /**
     * Not Completed Status Scope
     */
    public function scopeUnCompleted(Builder $builder): Builder
    {
        return $builder->whereNull('completed_at');
    }

    /**
     * Get the percentage of the model completion
     */
    public function percentageComplete(): int|float
    {
        return floor(($this->processed_rows / $this->total_rows) * 100);
    }

    /**
     * Fetch imports based on the given model
     */
    public function scopeForModel(Builder $builder, string $model): Builder
    {
        return $builder->where('model', $model);
    }

    /**
     * Fetch imports on the user id
     */
    public function scopeForUser(Builder $builder, int $user): Builder
    {
        return $builder->where('user_id', $user);
    }
}
