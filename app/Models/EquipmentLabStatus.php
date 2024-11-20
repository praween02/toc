<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentStatus extends Model
{
    use HasFactory;

    protected $table = 'equipment_lab_statuses';

    protected $fillable = [
        'equipment_id',
        'lab_status_id'
    ];

    protected function created_at(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => date("Y-m-d H:i:s"),
        );
    }
}
