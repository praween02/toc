<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SystemManualDataTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
//Load Model
use App\Models\{Institute, ProjectTimeline, SystemManual};

class SystemManualController extends Controller
{
    //
    protected $institute;
    protected $projectTimeline;
    protected $dataTable;
    protected $systemManual;

    public function __construct(SystemManual $systemManual,Institute $institute, ProjectTimeline $projectTimeline, SystemManualDataTable  $systemManualDataTable)
    { 
        //Define Datatable
        $this->dataTable = $systemManualDataTable;

        //Define Model
        $this->institute = $institute;
        $this->projectTimeline = $projectTimeline;
        $this->systemManual = $systemManual;

    }



    public function index()
    {
        return $this->dataTable->render('pages.system_manual.index');
    }
    public function create()
    {
        // abort_if(permission('institute.create'), 403, __('app.permission_denied'));
        $data['equipmentsList'] = $this->systemManual->getEquipmentList();

        return view('pages.system_manual.create', $data);
    }
}
