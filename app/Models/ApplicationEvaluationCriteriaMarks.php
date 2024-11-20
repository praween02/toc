<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationEvaluationCriteriaMarks extends Model
{
    use HasFactory;

    protected $table = 'application_evaluation_criteria_marks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'application_evaluation_criteria_id',
        'expert_id',
        'obtain_marks'
    ];

}
