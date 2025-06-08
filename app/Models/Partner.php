<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name_en',
        'company_name_tr',
        'company_name_nl',
        'logo_path',
        'description_en',
        'description_tr',
        'description_nl',
        'website',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
