<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUs extends Model
{
    use SoftDeletes;

    protected $fillable = [
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
        static::creating(function ($aboutUs) {
            if ($aboutUs->is_active) {
                self::where('is_active', 1)->update(['is_active' => 0]);
            }
        });

        static::updating(function ($aboutUs) {
            if ($aboutUs->is_active) {
                self::where('id', '!=', $aboutUs->id)->where('is_active', 1)->update(['is_active' => 0]);
            }
        });
    }
}
