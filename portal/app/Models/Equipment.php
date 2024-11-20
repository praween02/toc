<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\EquipmentLabStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'equipment',
    ];
	
	public function equipment_select(): HasMany {
        return $this->hasMany(EquipmentLabStatus::class, 'equipment_id', 'id');
    }

}
