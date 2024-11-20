<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\{HasOne,HasManyThrough,HasMany,HasOneThrough};

use App\Models\{Institute,VendorInstitute,Profile,Role,RoleUser,UserPermission};
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
	'parichay_auth_info'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
	
	
	public function profilePhotoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->profile_photo_path ?? '';
        });
    }

    protected function email(): Attribute
        {
            return Attribute::make(
                set: fn (string $value) => strtolower($value),
            );
        }

    /*protected function password(): Attribute
        {
            return Attribute::make(
                set: fn (string $value) => bcrypt($value),
            );
        }
*/

    public function profile(): HasOne {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    // public function role(): HasManyThrough {
    //     return $this->hasManyThrough(Role::class, RoleUser::class, 'user_id', 'id', 'id', 'role_id');
    // }

    public function role(): HasOneThrough {
        return $this->hasOneThrough(Role::class, RoleUser::class, 'user_id', 'id', 'id', 'role_id');
    }

    public function institutes(): HasManyThrough {
        return $this->hasManyThrough(Institute::class, VendorInstitute::class , 'institute_id', 'id', 'id' , 'institute_id');
    }

    public function inst(): HasOne
    {
        return $this->hasOne(Institute::class, 'institute_id', 'id');
    }

    public function permission(): HasOne{
        return $this->hasOne(UserPermission::class, 'user_id', 'id');
    }

    public function role_user(): HasOne {
        return $this->hasOne(RoleUser::class, 'user_id', 'id');
    }
}
