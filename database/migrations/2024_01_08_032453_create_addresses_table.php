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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->char('fullname')->nullable();
            $table->char('phonenumber')->nullable();
            $table->char('addresslabel')->nullable();
            $table->char('city')->nullable();
            $table->char('streetbuilding')->nullable();
            $table->char('detail')->nullable();
            $table->boolean('isMainAddress')->default(false);
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
