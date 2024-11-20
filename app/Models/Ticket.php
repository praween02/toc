<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User};

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_no',
        'status',
        'subject',
        'institute_id',
        'user_id',
        'closed_date',
        'closed_by'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
