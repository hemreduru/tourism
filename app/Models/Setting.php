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
    ];
}
