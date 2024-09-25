<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            array(
                [
                    'nama_user' => 'John Doe',
                    'username' => 'john_doe',
                    'password' => bcrypt('1234'),
                    'email' => 'admin@admin',
                    'no_hp' => '081234567890',
                    'wa' => '081234567890',
                    'pin' => '1234',
                    'id_jenis_user' => '1',
                    'create_by' => 'system',
                    'update_by' => 'system'
                ]
            )
        );
    }
}
