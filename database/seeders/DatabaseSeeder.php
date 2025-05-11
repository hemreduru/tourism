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
            RoleSeeder::class,  // Önce roller oluşturulmalı
            UserSeeder::class,  // Sonra kullanıcılar oluşturulmalı
        ]);
    }
}
