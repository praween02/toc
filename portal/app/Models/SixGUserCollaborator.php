<?php

namespace App\Models;

use App\Models\{Country,State,City};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SixGUserCollaborator extends Model
{
    use HasFactory;

    protected $table = '6g_application_collaborators';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
}