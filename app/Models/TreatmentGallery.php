<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Service;

class TreatmentGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'treatment_type_en',
        'treatment_type_tr',
        'treatment_type_nl',
        'before_image_path',
        'after_image_path',
        'service_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Related service (category).
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
