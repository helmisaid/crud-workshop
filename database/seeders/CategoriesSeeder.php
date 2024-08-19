<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Programming'],
            ['id_kategori' => 2, 'nama_kategori' => 'Database'],
            // Tambahkan data lainnya sesuai kebutuhan
        ]);
    }
}
