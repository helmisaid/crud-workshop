<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bukus')->insert([
            ['idbuku' => 1, 'kode_buku' => 'B001', 'judul_buku' => 'Belajar Laravel', 'pengarang' => 'John Doe', 'id_kategori' => 1],
            ['idbuku' => 2, 'kode_buku' => 'B002', 'judul_buku' => 'Mastering PHP', 'pengarang' => 'Jane Smith', 'id_kategori' => 2],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}
