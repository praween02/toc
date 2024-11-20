<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\EquipmentLabStatus;

class LabStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_path',
        'installation_path',
        'testing_path',
        'training_course'
    ];

    public function lab_select(): HasMany {
        return $this->hasMany(EquipmentLabStatus::class, 'lab_status_id', 'id');
    }

    protected function created_at(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => date("Y-m-d H:i:s"),
        );
    }
    
}

