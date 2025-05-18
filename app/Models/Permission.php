<?php

namespace App\Models;

use Laratrust\Models\Permission as PermissionModel;

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
class Permission extends PermissionModel
{
    public $guarded = [];

    /**
     * Permission'a uygun renk atar
     *
     * @param string $name
     * @return string
     */
    public static function getColorForPermissionType(string $name): string
    {
        $parts = explode('.', $name);
        $action = $parts[1] ?? '';

        return match($action) {
            'view' => 'warning',
            'create' => 'success',
            'edit', 'update' => 'info',
            'delete' => 'danger',
            default => 'primary',
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($permission) {
            if (empty($permission->color)) {
                $permission->color = self::getColorForPermissionType($permission->name);
            }
        });
    }
}
