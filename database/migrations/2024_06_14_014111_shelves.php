<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shelves', function(Blueprint $table){
            $table->id();
            
            $table->string('name', 10)
                ->nullable(false)
                ->unique();
            $table->boolean('active')
                ->default(true);
            $table->foreignId('level_id')
                ->constrained('levels')
                ->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
