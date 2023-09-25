<?php

use App\Models\Product;
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
            $table->uuid('id')->primary();
            $table->enum('size', Product::SIZES);
            $table->enum('type', Product::TYPES);
            $table->string('image');
            $table->string('description');
            $table->string('serial_number');
            $table->bigInteger('length');
            $table->bigInteger('height');
            $table->bigInteger('width');
            $table->bigInteger('price');
            $table->enum('status', Product::STATUS)->default(Product::INSTOCK);
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
