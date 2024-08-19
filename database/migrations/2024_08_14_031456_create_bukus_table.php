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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('idbuku'); 
            $table->string('kode_buku')->unique();
            $table->string('judul_buku');
            $table->string('pengarang');
            $table->unsignedBigInteger('id_kategori'); // Pastikan tipe datanya sama dengan kolom id_kategori di tabel categories
            $table->timestamps();
        
            // Menambahkan foreign key constraint
            $table->foreign('id_kategori')->references('id_kategori')->on('categories')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
