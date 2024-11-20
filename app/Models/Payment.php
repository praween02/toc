<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{User,Institute,UserInstitute};

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'utr_no',
        'transaction_date',
        'amount'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('name');
    }

    public function institute()
      {
         return $this->hasOneThrough(Institute::class, UserInstitute::class, 'user_id', 'id', 'user_id', 'institute_id');
      }

}
