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
        // Rolleri alıyoruz
        $adminRole = Role::where('name', 'admin')->first();
        $supervisorRole = Role::where('name', 'supervisor')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $userRole = Role::where('name', 'user')->first();

        // Admin kullanıcısı
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->roles()->attach($adminRole);

        // Supervisor kullanıcısı
        $supervisor = User::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@example.com',
            'password' => Hash::make('password'),
        ]);
        $supervisor->roles()->attach($supervisorRole);

        // Manager kullanıcısı
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ]);
        $manager->roles()->attach($managerRole);

        // Editor kullanıcısı
        $editor = User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
        ]);
        $editor->roles()->attach($editorRole);

        // Normal kullanıcı
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->roles()->attach($userRole);
    }
}
