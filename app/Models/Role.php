<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

/**
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property string $color
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $id
 */



class Role extends RoleModel
{
    public $guarded = [];

    protected $fillable = ['name', 'display_name', 'description','color'];

    /**
     * Bootstrap renkleri
     *
     * @return array
     */
    public static function getAvailableColors(): array
    {
        return [
            'primary' => 'Mavi',
            'secondary' => 'Gri',
            'success' => 'Yeşil',
            'danger' => 'Kırmızı',
            'warning' => 'Sarı',
            'info' => 'Açık Mavi',
            'dark' => 'Siyah',
            'light' => 'Beyaz'
        ];
    }
}
