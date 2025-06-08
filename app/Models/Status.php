<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en', 'name_tr', 'name_nl', 'color',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get the name of the status in the current application locale.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"name_$locale"} ?? $this->name_en; // Fallback to English if the locale is not available
    }

    /**
     * color
     *
     * @return string
     */
    public function getColorAttribute()
    {
        return $this->attributes['color'];
    }
}

