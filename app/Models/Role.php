<?php

namespace App\Models;

use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'permission',
        'status'
    ];

    protected function permission(): Attribute
        {
            return Attribute::make(
                get: fn (string $value) => ($value ? unserialize($value) : ''),
            );
        }

    public function total_users(): HasMany {
        return $this->hasMany(RoleUser::class, 'role_id', 'id');
    }

    protected function created_at(): Attribute
        {
            return Attribute::make(
                set: fn (string $value) => date("Y-m-d H:i:s"),
            );
        }
        
}
