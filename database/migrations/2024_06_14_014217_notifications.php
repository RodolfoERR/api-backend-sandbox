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
        Schema::create('notifications', function(Blueprint $table){
            $table->id();

            $table->string('name', 25)
                ->nullable(false);
            $table->text('description')
                ->nullable();
            $table->boolean('active')
                ->default(true);
            
            $table->foreignId('refaction_id')
                ->nullable()
                ->constrained('refactions', 'id');
            $table->foreignId('re_id')
                ->nullable()
                ->constrained('register_details', 'id');

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
