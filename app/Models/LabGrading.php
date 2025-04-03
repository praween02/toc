<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabGrading extends Model
{
    protected $fillable = [
        'institute_id',
        'innovation_project_check',
        'beyond_contribution',
        'use_case_definition',
        'poc_readiness_check',
        'commercial_product_validation',
        'ip_identification'
    ];

    protected $casts = [
        'innovation_project_check' => 'boolean',
        'beyond_contribution' => 'boolean',
        'poc_readiness_check' => 'boolean',
        'commercial_product_validation' => 'boolean',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
} 