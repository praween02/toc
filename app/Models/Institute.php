<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'institute',
        'address',
        'email',
        'contact_person',
        'contact_number',
        'status'
    ];

    protected function created_at(): Attribute {
            return Attribute::make(
                set: fn (string $value) => date("Y-m-d H:i:s"),
            );
    }

}
