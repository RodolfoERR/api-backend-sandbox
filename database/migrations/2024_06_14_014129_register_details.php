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
        Schema::create('register_details', function(Blueprint $table){
            $table->id();

            $table->unsignedInteger('quantity')
                ->nullable(false);

            $table->foreignId('register_id')
                ->constrained('registers', 'id');
            $table->foreignId('refaction_id')
                ->constrained('refactions', 'id');

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
