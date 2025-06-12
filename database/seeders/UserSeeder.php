<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sadece admin rolünü alıyoruz
        $adminRole = Role::where('name', 'admin')->first();

        // Sadece bir admin kullanıcısı oluşturuyoruz
        $admin = User::create([
            'name' => 'Hurşit Emre Duru',
            'email' => 'hemreduru@gmail.com',
            'password' => Hash::make('Emre20*0'),
        ]);

        // Kullanıcıya admin rolünü atıyoruz
        $admin->roles()->attach($adminRole);
    }
}
