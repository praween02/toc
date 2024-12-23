<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\EquipmentLabStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\Auth;

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
        'date',
        'type',
        'display',
        'no_of_page',
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
    public function getSystemManualList():QueryBuilder
    {


        $users = DB::table('system_manual')
        ->join('equipments', 'system_manual.equipment_id', '=', 'equipments.id')
        ->select('system_manual.id as id', 'equipments.equipment as equipment_name', 'system_manual.document_title as document_title', 'system_manual.document_description as document_description',
         'system_manual.document_file as document_file', 'system_manual.type as type', 'system_manual.no_of_page as no_of_page')
        ->where('system_manual.display', '0')
        ->where('system_manual.created_by',Auth::user()->id)
        ->get();
        return $users;

    }
}
