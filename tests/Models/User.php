<?php

namespace Coderflex\LaravelCsv\Tests\Models;

use Coderflex\LaravelCsv\Concerns\HasCsvImports;
use Coderflex\LaravelCsv\Tests\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    use HasCsvImports;

    protected $guarded = [];

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
