<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'title_en',
        'title_tr',
        'title_nl',
        'content_en',
        'content_tr',
        'content_nl',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::saving(function ($policy) {
            // Ensure only one active record per type
            if ($policy->is_active) {
                self::where('type', $policy->type)
                    ->where('id', '!=', $policy->id ?? 0)
                    ->update(['is_active' => 0]);
            }
        });
    }
}
