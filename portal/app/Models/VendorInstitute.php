<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorInstitute extends Model
{
    use HasFactory;

    protected $table = 'vendor_zone_institutes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vendor_zone_id',
        'institute_id',
        'random_id'
    ];

}
