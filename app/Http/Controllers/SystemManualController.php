<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SystemManualDataTable;
use App\DataTables\SystemManualDataTable2;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//Load Model
use App\Models\{Institute, ProjectTimeline, SystemManual};

class SystemManualController extends Controller
{
    //
    protected $institute;
    protected $projectTimeline;
    protected $dataTable;
    protected $dataTable2;
    protected $systemManual;

    public function __construct(SystemManual $systemManual,Institute $institute, ProjectTimeline $projectTimeline, SystemManualDataTable  $systemManualDataTable,SystemManualDataTable2  $systemManualDataTable2)
    { 
        //Define Datatable
        $this->dataTable = $systemManualDataTable;
        $this->dataTable2 = $systemManualDataTable2;

        //Define Model
        $this->institute = $institute;
        $this->projectTimeline = $projectTimeline;
        $this->systemManual = $systemManual;

    }



    public function index(SystemManualDataTable $dataTable)
    {
        return $dataTable->render('pages.system_manual.index');
    }
    public function uatSignature()
    {
        return $this->dataTable2->render('pages.system_manual.uatSignature');
    }
    public function create()
    {
        // abort_if(permission('institute.create'), 403, __('app.permission_denied'));
        $data['equipmentsList'] = $this->systemManual->getEquipmentList();

        return view('pages.system_manual.create', $data);
    }

    public function signature_create()
    {
        return view('pages.system_manual.uatSignatureCreate');
    }

    public function store(Request $request, $id = null)
    {
        $rules = [
            'document_title' => 'required|string|max:255',
            'document_description' => 'nullable|string',
            'no_of_page' => 'required|integer|min:1',
            'type' => 'required|integer',
        ];
    
        // Conditionally make document_file required if $id is null
        if (is_null($id)) {
            $rules['document_file'] = 'required|file|mimes:pdf|max:10240';
        } else {
            $rules['document_file'] = 'nullable|file|mimes:pdf|max:10240';
        }
    
        // Validate the request
        $validatedData = $request->validate($rules);

        $filePath = $id ? SystemManual::findOrFail($id)->document_file : null;

        if ($request->hasFile('document_file')) {
            // Store the file and get the path
            $filePath = $request->file('document_file')->store('documents', 'custom');
        }
        $currentDate = Carbon::now();

        // You can format the date as well
        $formattedDate = $currentDate->format('Y-m-d');
        // Create or update the record
        $systemManual = SystemManual::updateOrCreate(
            ['id' => $id],
            [
                'equipment_id' => $request->input('equipment_id', 0),
                'document_title' => $validatedData['document_title'],
                'document_description' => $validatedData['document_description'],
                'document_file' => $filePath,
                'no_of_page' => $validatedData['no_of_page'],
                'type' => $validatedData['type'],
                'date' => $request->input('date')??$formattedDate,
                'created_by' => Auth::user()->id,
            ]
        );
        $message = $id ? 'Updated successfully' : 'Submitted successfully';
        Session::flash('message', $message);
        if($validatedData['type']==4){
            return redirect()->route('system_manual.signature-uat')->with('success', 'Data saved successfully!');
        }
        return redirect()->route('system_manual.index')->with('success', 'Data saved successfully!');
    }
    public function edit($id)
    {
        // Retrieve the record
        $systemManual = $this->systemManual->findOrFail($id);

        // Ensure you pass the list of equipment and the current data
        $data = [
            'systemManual' => $systemManual,
            'equipmentsList' => $this->systemManual->getEquipmentList(),
        ];

        return view('pages.system_manual.edit', $data);
    }
    public function signature_edit($id)
    {
        // Retrieve the record
        $systemManual = $this->systemManual->findOrFail($id);

        // Ensure you pass the list of equipment and the current data
        $data = [
            'systemManual' => $systemManual,
            'equipmentsList' => $this->systemManual->getEquipmentList(),
        ];

        return view('pages.system_manual.uatSignatureEdit', $data);
    }

    public function delete($id)
    {
        // Find the record by ID
        $systemManual = $this->systemManual->findOrFail($id);

        // Update the `display` column to `1`
        $systemManual->update(['display' => 1]);

        Session::flash('message', 'Record deleted successfully');
        return redirect()->route('system_manual.index')->with('success', 'Data saved successfully!');
    }

}
