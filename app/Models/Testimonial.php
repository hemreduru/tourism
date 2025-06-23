<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en', 'name_tr', 'name_nl',
        'title_en', 'title_tr', 'title_nl',
        'comment_en', 'comment_tr', 'comment_nl',
        'image_path', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
