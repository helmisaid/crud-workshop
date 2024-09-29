<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_menu_user')->insert([
            [
                'no_setting' => '2',
                'id_jenis_user' => 1,
                'menu_id' => 2,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:42:43',
                'updated_at' => '2024-09-24 09:42:43',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '3',
                'id_jenis_user' => 1,
                'menu_id' => 3,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:43:03',
                'updated_at' => '2024-09-24 09:43:03',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '4',
                'id_jenis_user' => 1,
                'menu_id' => 4,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:43:21',
                'updated_at' => '2024-09-24 09:43:21',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '6',
                'id_jenis_user' => 1,
                'menu_id' => 6,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:44:05',
                'updated_at' => '2024-09-24 09:44:05',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '6',
                'id_jenis_user' => 1,
                'menu_id' => 7,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:44:28',
                'updated_at' => '2024-09-24 09:44:28',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '7',
                'id_jenis_user' => 1,
                'menu_id' => 8,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:45:04',
                'updated_at' => '2024-09-24 09:45:04',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '8',
                'id_jenis_user' => 2,
                'menu_id' => 1,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:45:51',
                'updated_at' => '2024-09-24 09:45:51',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '9',
                'id_jenis_user' => 6,
                'menu_id' => 2,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:51:12',
                'updated_at' => '2024-09-24 09:51:12',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '10',
                'id_jenis_user' => 6,
                'menu_id' => 3,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 09:53:58',
                'updated_at' => '2024-09-24 10:01:22',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '11',
                'id_jenis_user' => 6,
                'menu_id' => 1,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 10:02:05',
                'updated_at' => '2024-09-24 10:02:05',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '13',
                'id_jenis_user' => 1,
                'menu_id' => 5,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 18:00:45',
                'updated_at' => '2024-09-24 18:00:45',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
             [
                'no_setting' => '14',
                'id_jenis_user' => 1,
                'menu_id' => 10,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 18:00:45',
                'updated_at' => '2024-09-24 18:00:45',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '15',
                'id_jenis_user' => 1,
                'menu_id' => 11,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 18:00:45',
                'updated_at' => '2024-09-24 18:00:45',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '16',
                'id_jenis_user' => 1,
                'menu_id' => 12,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 18:00:45',
                'updated_at' => '2024-09-24 18:00:45',
                'delete_mark' => 0,
                'deleted_at' => null,
            ],
            [
                'no_setting' => '17',
                'id_jenis_user' => 1,
                'menu_id' => 13,
                'create_by' => 'Arya',
                'created_at' => '2024-09-24 18:00:45',
                'updated_at' => '2024-09-24 18:00:45',
                'delete_mark' => 0,
                'deleted_at' => null,
            ]
        ]);
    }
}
