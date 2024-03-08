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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('price');
            $table->bigInteger('stock');
            $table->string('storage');
            $table->text('image');
            $table->text('image2')->nullable();;
            $table->text('image3')->nullable();;
            $table->text('image4')->nullable();;
            $table->text('description')->nullable();
            $table->boolean('isDisplayed')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
