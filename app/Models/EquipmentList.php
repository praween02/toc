<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentList extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_name',
        'model_no',
        'date',
        'running_time',
        'institute_id',
    ];

    /**
     * Get the institute that owns the equipment.
     */
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
} 