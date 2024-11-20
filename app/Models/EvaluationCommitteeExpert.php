<?php

namespace App\Models;

use App\Models\{City,State,Country,Expertise};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationCommitteeExpert extends Model
{
    use HasFactory;

    protected $table = 'evaluation_committee_experts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'evaluation_committee_id',
        'expert_id'
    ];

}
