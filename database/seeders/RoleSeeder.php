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
        $adminRole = Role::firstOrCreate(['name' => 'admin'], [
            'display_name' => 'Admin',
            'description' => 'Sistem yöneticisi, tüm yetkilere sahip',
            'color' => 'danger',
        ]);

        $editorRole = Role::firstOrCreate(['name' => 'editor'], [
            'display_name' => 'Editör',
            'description' => 'Editör, içerik düzenleme yetkisine sahip',
            'color' => 'info',
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

            // About Us yönetimi
            ['name' => 'about_us.view', 'display_name' => 'Hakkımızda Görüntüle'],
            ['name' => 'about_us.create', 'display_name' => 'Hakkımızda Oluştur'],
            ['name' => 'about_us.edit', 'display_name' => 'Hakkımızda Düzenle'],
            ['name' => 'about_us.delete', 'display_name' => 'Hakkımızda Sil'],

            // Services yönetimi
            ['name' => 'services.view', 'display_name' => 'Hizmetleri Görüntüle'],
            ['name' => 'services.create', 'display_name' => 'Hizmet Oluştur'],
            ['name' => 'services.edit', 'display_name' => 'Hizmet Düzenle'],
            ['name' => 'services.delete', 'display_name' => 'Hizmet Sil'],

            // Partners yönetimi
            ['name' => 'partners.view', 'display_name' => 'Partnere Görüntüle'],
            ['name' => 'partners.create', 'display_name' => 'Partner Oluştur'],
            ['name' => 'partners.edit', 'display_name' => 'Partner Düzenle'],
            ['name' => 'partners.delete', 'display_name' => 'Partner Sil'],

            // Contacts yönetimi
            ['name' => 'contacts.view', 'display_name' => 'İletişim Taleplerini Görüntüle'],
            ['name' => 'contacts.create', 'display_name' => 'İletişim Talebi Oluştur'],
            ['name' => 'contacts.edit', 'display_name' => 'İletişim Talebi Düzenle'],
            ['name' => 'contacts.delete', 'display_name' => 'İletişim Talebi Sil'],

            // Rol atama yetkisi
            ['name' => 'roles.assign', 'display_name' => 'Rol Ata'],
        ];

        // Yetkileri veritabanına ekle
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // 3. Rollere yetkileri ata
        // Admin: tüm yetkiler
        $adminRole->permissions()->syncWithoutDetaching(Permission::all()->pluck('id'));

        // Editor: sadece rol atama yetkisi
        $editorRole->permissions()->syncWithoutDetaching(
            Permission::whereIn('name', [
                'users.view', // Kullanıcıları görebilmeli
                'users.create', // Kullanıcı oluşturabilmeli
                'users.edit', // Kullanıcı düzenleyebilmeli
                'users.delete', // Kullanıcı silebilmeli
                'roles.view', // Rolleri görebilmeli
                'roles.assign' // Rol atayabilmeli
            ])->pluck('id')
        );

        // User: hiçbir yetkisi yok - boş array
        // $userRole->permissions()->attach([]);
        // Hiçbir yetki eklemiyoruz
    }
}
