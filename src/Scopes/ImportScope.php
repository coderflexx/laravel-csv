<?php

namespace Coderflex\LaravelCsv\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User;

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
    public function scopeUnCompleted(Builder $builder): Builder
    {
        return $builder->whereNull('completed_at');
    }

    /**
     * Get the percentage of the model completion
     *
     * @return int
     */
    public function percentageComplete(): int
    {
        return floor(($this->processed_rows / $this->total_rows) * 100);
    }

    /**
     * Fetch imports based on the given model
     *
     * @param  string  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForModel(Builder $builder, string $model): Builder
    {
        return $builder->where('model', $model);
    }

    /**
     * Fetch imports on the user id
     *
     * @param  int  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser(Builder $builder, int $user): Builder
    {
        return $builder->where('user_id', $user);
    }
}
