<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'post_id' => Str::uuid(),
            'sender' => 'user123', // Nama pengguna atau username sementara
            'message_text' => 'Ini adalah pesan sementara untuk testing.',
            'message_image' => 'https://example.com/image.jpg', // Bisa disesuaikan
            'create_by' => 'user123', // Nama pengguna atau username sementara
            'create_date' => now(), // Tanggal dan waktu saat ini
            'delete_mark' => '0', // Tanda untuk soft delete
        ]);
    }
}
