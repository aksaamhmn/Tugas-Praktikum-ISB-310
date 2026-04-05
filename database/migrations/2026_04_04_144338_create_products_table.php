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
            $table->id('product_id'); // Primary Key

            // Kolom penampung Foreign Key
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            // Definisi relasi Foreign Key (Jika kategori/brand dihapus, produk ikut terhapus berkat cascade)
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');

            // Kolom data produk
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('product_stock');
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
