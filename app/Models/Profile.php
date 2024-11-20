<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany,BelongsToMany};

use App\Models\{Institute,VendorInstitute};


class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address1',
        'address2',
        'mobile',
    ];

    protected function created_at(): Attribute {
            return Attribute::make(
                set: fn (string $value) => date("Y-m-d H:i:s"),
            );
    }

    public function institutes():HasMany {
        return $this->hasMany(VendorInstitute::class , 'vendor_id', 'user_id');
    }

}
