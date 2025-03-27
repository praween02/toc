<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'applicant_category',
        'subcategory',
        'person_name',
        'qualification',
        'designation',
        'institute_id',
        'institute_company',
        'address',
        'mobile_no',
        'email_id',
        'reason',
        'status',
        'reject_reason'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the formatted created date.
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d M Y, h:i A');
    }

    /**
     * Get the institute that this registration belongs to.
     */
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
}
