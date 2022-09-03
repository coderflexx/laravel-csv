<?php

namespace Coderflex\LaravelCsv\Tests\Models;

use Coderflex\LaravelCsv\Tests\Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return CustomerFactory::new();
    }
}
