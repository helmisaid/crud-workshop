<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_user')->insert([
            ['jenis_user' => 'admin'],
            ['jenis_user' => 'user'],
            ['jenis_user' => 'guest'],
            ['jenis_user' => 'superadmin'],
            ['jenis_user' => 'editor'],
            ['jenis_user' => 'Staff Perpustakaan']
        ]);
    }
}
