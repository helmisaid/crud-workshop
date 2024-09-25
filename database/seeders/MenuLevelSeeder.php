<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $menuLevels = [
            [
                'id_level' => '1',
                'level' => 'Admin',
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_mark' => false,
            ],
            [
                'id_level' => '2',
                'level' => 'User',
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_mark' => false,
            ],
            [
                'id_level' => '3',
                'level' => 'Guest',
                'create_by' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_mark' => false,
            ],
        ];

        DB::table('menu_levels')->insert($menuLevels);
    }
}
