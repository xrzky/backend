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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->char('firstName')->nullable();
            $table->char('lastName')->nullable();
            $table->char('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->char('city')->nullable();
            $table->char('province')->nullable();
            $table->char('postalCode')->nullable();
            $table->char('country')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
