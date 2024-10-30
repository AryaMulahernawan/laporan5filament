<?php

// database/migrations/xxxx_xx_xx_create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->foreignId('kategori_id')->constrained('categories')->onDelete('cascade');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->string('foto_produk')->nullable();
            $table->string('file_produk')->nullable();
            $table->boolean('status')->default(true); // Status produk aktif/inaktif
            $table->enum('tipe_produk', ['fisik', 'digital'])->default('fisik'); // Tambahkan kolom tipe_produk
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}