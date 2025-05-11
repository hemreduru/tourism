<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Rolleri oluştur
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Sistem yöneticisi, tüm yetkilere sahip',
            'color' => 'danger',
        ]);

        $supervisorRole = Role::create([
            'name' => 'supervisor',
            'display_name' => 'Supervisor',
            'description' => 'Süpervizör, birçok yetkiye sahip',
            'color' => 'warning',
        ]);

        $managerRole = Role::create([
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'Yönetici, sadece kendi bölümünü yönetebilir',
            'color' => 'success',
        ]);

        $editorRole = Role::create([
            'name' => 'editor',
            'display_name' => 'Editör',
            'description' => 'Editör, içerik düzenleme yetkisine sahip',
            'color' => 'info',
        ]);

        $userRole = Role::create([
            'name' => 'user',
            'display_name' => 'Kullanıcı',
            'description' => 'Standart kullanıcı, kısıtlı yetkilerle',
            'color' => 'primary',
        ]);

        // 2. Temel yetkileri oluştur
        $permissions = [
            // Kullanıcı yönetimi
            ['name' => 'users.view', 'display_name' => 'Kullanıcıları Görüntüle'],
            ['name' => 'users.create', 'display_name' => 'Kullanıcı Oluştur'],
            ['name' => 'users.edit', 'display_name' => 'Kullanıcı Düzenle'],
            ['name' => 'users.delete', 'display_name' => 'Kullanıcı Sil'],

            // Rol yönetimi
            ['name' => 'roles.view', 'display_name' => 'Rolleri Görüntüle'],
            ['name' => 'roles.create', 'display_name' => 'Rol Oluştur'],
            ['name' => 'roles.edit', 'display_name' => 'Rol Düzenle'],
            ['name' => 'roles.delete', 'display_name' => 'Rol Sil'],

            // Yetki yönetimi
            ['name' => 'permissions.view', 'display_name' => 'Yetkileri Görüntüle'],
            ['name' => 'permissions.create', 'display_name' => 'Yetki Oluştur'],
            ['name' => 'permissions.edit', 'display_name' => 'Yetki Düzenle'],
            ['name' => 'permissions.delete', 'display_name' => 'Yetki Sil'],

            // Rol atama yetkisi
            ['name' => 'roles.assign', 'display_name' => 'Rol Ata'],
        ];

        // Yetkileri veritabanına ekle
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // 3. Rollere yetkileri ata
        // Admin: tüm yetkiler
        $adminRole->permissions()->attach(Permission::all());

        // Editor: sadece rol atama yetkisi
        $editorRole->permissions()->attach(
            Permission::whereIn('name', [
                'users.view', // Kullanıcıları görebilmeli
                'roles.view', // Rolleri görebilmeli
                'roles.assign' // Rol atayabilmeli
            ])->get()
        );

        // User: hiçbir yetkisi yok - boş array
        // $userRole->permissions()->attach([]);
        // Hiçbir yetki eklemiyoruz
    }
}
