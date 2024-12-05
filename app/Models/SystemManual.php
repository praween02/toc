<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


use App\Models\{Equipment};


class SystemManual extends Model
{
    use HasFactory;


    protected $table = 'system_manual';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'equipment_id',
        'document_title',
        'document_description',
        'document_file',

        'type',


   'created_by',

    ];

    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }

    public function getEquipmentList()
    {
        $equipments = DB::table('equipments')->orderBy('equipment', 'ASC')->get();
        return $equipments;
    }
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
