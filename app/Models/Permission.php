<?php

namespace App\Models;

use Laratrust\Models\Permission as PermissionModel;

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
