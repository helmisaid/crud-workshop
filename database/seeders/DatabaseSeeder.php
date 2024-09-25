<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\SettingMenuSeeder;
use Database\Seeders\SettingMenuUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'nama_user' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CategoriesSeeder::class,
            BukuSeeder::class,
            JenisUserSeeder::class,
            UserSeeder::class,
            MenuLevelSeeder::class,
            MenuSeeder::class,
            SettingMenuSeeder::class
        ]);
    }

    
}
