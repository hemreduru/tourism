<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name_en',
        'company_name_tr',
        'company_name_nl',
        'image_path',
        'short_description_en',
        'short_description_tr',
        'short_description_nl',
        'content_en',
        'content_tr',
        'content_nl',
        'link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
