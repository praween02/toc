<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SystemManualDataTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'document_title' => 'required|string|max:255',
            'document_description' => 'nullable|string',
            'document_file' => 'required|file|mimes:pdf|max:10240', // 10MB max for the PDF
            'no_of_page' => 'required|integer',
            'type' => 'required|integer',
        ]);
        $requestArr = $request->all();

        // Handle the file upload
        if ($request->hasFile('document_file')) {
            // Save the file and get the path
            $documentFilePath = $request->file('document_file')->store('documents', 'public');
        }

        // Create the new record in the Tikal table
        $tikal = SystemManual::create([
            'equipment_id' => $requestArr['equipment_id'] ?? 0,
            'document_title' => $validatedData['document_title'],
            'document_description' => $validatedData['document_description'],
            'document_file' => $documentFilePath ?? null,  // Save file path if file exists
            'no_of_page' => $validatedData['no_of_page'],
            'type' => $validatedData['type'],
        ]);
        Session::flash('message', 'Submitted successfully'); 
        // Redirect back or to a new page with success message
        return redirect()->route('system_manual.index')->with('success', 'Data saved successfully!');


    }

}
