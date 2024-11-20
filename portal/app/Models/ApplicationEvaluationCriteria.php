<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationEvaluationCriteria extends Model
{
    use HasFactory;

    protected $table = 'application_evaluation_criteria';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'application_id',
        'criteria',
        'max_marks'
    ];

}
