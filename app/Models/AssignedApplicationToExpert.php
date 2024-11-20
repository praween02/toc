<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedApplicationToExpert extends Model
{
    use HasFactory;

    protected $table = 'assigned_6g_application_to_expert';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'application_id',
        'team_id',
        'remarks'
    ];

}
