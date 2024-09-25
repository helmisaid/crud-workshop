<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'menu_id' => 1,
                'level_id' => '1', // Sesuaikan dengan level_id yang benar
                'menu_name' => 'Dashboard',
                'menu_link' => 'dashboard',
                'menu_icon' => 'icon-grid',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 2,
                'level_id' => '1',
                'menu_name' => 'Buku',
                'menu_link' => 'bukus',
                'menu_icon' => 'icon-layout',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 3,
                'level_id' => '1',
                'menu_name' => 'Kategori',
                'menu_link' => 'categories',
                'menu_icon' => 'mdi mdi-tag',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 4,
                'level_id' => '1',
                'menu_name' => 'Users',
                'menu_link' => 'users',
                'menu_icon' => 'mdi mdi-account-group',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 5,
                'level_id' => '1',
                'menu_name' => 'Jenis User',
                'menu_link' => 'jenis-user',
                'menu_icon' => 'mdi mdi-account',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 6,
                'level_id' => '1',
                'menu_name' => 'Master Menu',
                'menu_link' => 'menus',
                'menu_icon' => 'mdi mdi-menu',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 7,
                'level_id' => '1',
                'menu_name' => 'Master Menu Level',
                'menu_link' => 'menu-levels',
                'menu_icon' => 'mdi mdi-format-list-bulleted',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 8,
                'level_id' => '1',
                'menu_name' => 'Setting Menu User',
                'menu_link' => 'settingmenuuser',
                'menu_icon' => 'mdi mdi-cog',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_id' => 9,
                'level_id' => '1',
                'menu_name' => 'Tugas',
                'menu_link' => '#', // Jika ini submenu, tambahkan di parent_id
                'menu_icon' => 'icon-grid',
                'parent_id' => null,
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('menus')->insert($menus);
    }

}
