<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Önce rolleri oluştur, sonra kullanıcıları
        $this->call([
            RoleSeeder::class,
            StatusSeeder::class,
            UserSeeder::class,
            AboutUsSeeder::class,
            ServiceSeeder::class,
            PartnerSeeder::class,
            ContactSeeder::class,
            SettingsTableSeeder::class,
        ]);
    }
}
