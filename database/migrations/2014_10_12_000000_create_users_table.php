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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('email')
                ->nullable(false)
                ->unique();
            $table->string('f_name')
                ->nullable(false);
            $table->string('l_name')
                ->nullable(false);
            $table->char('phone', 10)
                ->nulleable(false);
            $table->boolean('active')
                ->default(false);
            $table->string('fingerprint')
                ->nullable(true);
            $table->string('password')
                ->nullable(false);
            
            
            $table->string('code')
                ->nullable(true);
            $table->foreignId('role_id')
                ->constrained('roles')
                ->references('id');

            $table->rememberToken();
            $table->timestamp('email_verified_at')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
