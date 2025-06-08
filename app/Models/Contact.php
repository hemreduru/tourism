<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time_slot',
        'message_en',
        'message_tr',
        'message_nl',
        'status_id',
        'language',
        'is_read',
        'is_responded',
    ];

    protected $casts = [
        'date' => 'date',
        'is_read' => 'boolean',
        'is_responded' => 'boolean',
    ];

    /**
     * İletişim talebinin durumu ile ilişkisi
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Belirli bir dildeki mesajı döndürür
     *
     * @return string|null
     */
    public function getMessageAttribute()
    {
        $lang = app()->getLocale();
        return $this->{"message_$lang"};
    }

    /**
     * Tarih ve saat bilgisini birleştirerek döndürür
     *
     * @return string
     */
    public function getDateTimeAttribute()
    {
        return $this->date->format('d.m.Y') . ' | ' . $this->time_slot;
    }
}
