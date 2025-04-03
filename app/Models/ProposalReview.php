<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalReview extends Model
{
    protected $fillable = [
        'proposal_id',
        'reviewed_by',
        'is_5g_innovation',
        'is_5g_beyond_contribution',
        'use_case_definition',
        'is_poc_ready',
        'has_commercial_validation',
        'ip_identification',
        'status',
        'rejection_reason',
        'revision_notes'
    ];

    protected $casts = [
        'is_5g_innovation' => 'boolean',
        'is_5g_beyond_contribution' => 'boolean',
        'is_poc_ready' => 'boolean',
        'has_commercial_validation' => 'boolean',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
} 