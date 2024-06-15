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
        Schema::create('refactions', function(Blueprint $table){
            $table->id();

            $table->string('name')
                ->nullable(false);
            $table->text('descriprion')
                ->nullable();
            $table->unsignedInteger('total_quantity')
                ->nullable(false);
            $table->unsignedInteger('unit_price')
                ->nullable(false)
                ->default(0);
            $table->boolean('active')
                ->default(true);

            $table->foreignId('type_id')
                ->constrained('types')
                ->references('id');
            $table->foreignId('location_id')
                ->constrained('shelves')
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
