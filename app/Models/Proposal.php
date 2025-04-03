<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposals';
    protected $fillable = [
        'title',
        'description',
        'attachment',
        'expected_completion_date',
        'expected_output',
        'user_id',
        'institute_id',
        'status',
        'socio_economic_vertical',
        'stack_holder',
        'proposal_brief',
        'days_required'
    ];

    protected $casts = [
        'expected_completion_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function teamMembers()
    {
        return $this->belongsToMany(User::class, 'proposal_team_members')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function review()
    {
        return $this->hasOne(ProposalReview::class, 'proposal_id');
    }

    public function authorizeReview()
    {
        return $this->institute_id === auth()->user()->institute_id;
    }

} 