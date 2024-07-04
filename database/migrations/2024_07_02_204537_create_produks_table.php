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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->unsignedBigInteger('kategori_produk_id');
            $table->string('gambar_produk')->nullable();
            $table->text('deskripsi_produk');
            $table->integer('jumlah_produk');
            $table->decimal('harga_produk', 10, 2);
            $table->timestamps();

            $table->foreign('kategori_produk_id')
                ->references('id')
                ->on('kategori_produk')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
