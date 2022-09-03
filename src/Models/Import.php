<?php

namespace Coderflex\LaravelCsv\Models;

use Coderflex\LaravelCsv\Scopes;
use Illuminate\Database\Eloquent\Model;

/**
 * Coderflex\LaravelCsv\Models\Import
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $model
 * @property string $file_path
 * @property string $file_name
 * @property int $total_rows
 * @property int $processed_rows
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Import extends Model
{
    use Scopes\ImportScope;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'csv_imports';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];
}
