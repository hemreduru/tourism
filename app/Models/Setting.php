<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'whatsapp',
        'latitude',
        'longitude',
        'address_en',
        'address_tr',
        'address_nl',
        'hero_heading_en',
        'hero_heading_tr',
        'hero_heading_nl',
        'hero_description_en',
        'hero_description_tr',
        'hero_description_nl',
        'top_footer_heading_en',
        'top_footer_heading_tr',
        'top_footer_heading_nl',
        'top_footer_lead_en',
        'top_footer_lead_tr',
        'top_footer_lead_nl',
    ];
}
