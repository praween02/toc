<?php

namespace App\Models;

use App\Models\{TelecomDepartment,UserTelecomDepartment};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\{HasOneThrough};

class TelecomProject extends Model
{
    use HasFactory;

    protected $table = 'telecom_projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'project',
        'implement_agency',
        'core_technology',
        'cost',
    ];

    public function telecom_department(): HasOneThrough {
        return $this->hasOneThrough(TelecomDepartment::class, UserTelecomDepartment::class, 'user_id', 'id', 'user_id', 'department_id');
    }

}
