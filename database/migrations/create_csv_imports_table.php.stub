<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('csv_imports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('model');
            $table->string('file_path');
            $table->string('file_name');
            $table->unsignedBigInteger('total_rows');
            $table->unsignedBigInteger('processed_rows')->default(0);
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
        });
    }
};
