<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstituteUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'first_name',
        'last_name',
        'phone_no',
        'email_id',
        'username',
        'profile_pic',
        'gender',
        'user_type',
	'created_by'
    ];

    protected function created_at(): Attribute {
            return Attribute::make(
                set: fn (string $value) => date("Y-m-d H:i:s"),
            );
    }

    protected function first_name(): Attribute
        {
            return Attribute::make(
                set: fn (string $value) => ucwords(strtolower($value))
            );
        }

    protected function last_name(): Attribute
        {
            return Attribute::make(
                set: fn (string $value) => ucwords(strtolower($value))
            );
        }
    
    protected function email(): Attribute
        {
            return Attribute::make(
                set: fn (string $value) => strtolower($value)
            );
        }

}
