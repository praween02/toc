<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SystemManualDataTable;
use App\DataTables\SystemManualDataTable2;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Model\EquipmentLabStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
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

    public function __construct(SystemManual $systemManual, Institute $institute, ProjectTimeline $projectTimeline, SystemManualDataTable  $systemManualDataTable, SystemManualDataTable2  $systemManualDataTable2)
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

    public function receipt_goods_create()
    {
        return view('pages.system_manual.ReceiptOfGoodsCreate');
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
        // For Equipment id required
        if ($validatedData['type'] == 1 && $request->input('equipment_id') <= 0) {
            return redirect()->back()->withInput()->with('error', 'Equipment ID is required.');
        }
        // For UAT Sign documnet id required
        if ($validatedData['type'] == 4 && $validatedData['type'] == NULL) {
            return redirect()->back()->withInput()->with('error', 'Sign date is required.');
        }
        $currentDate = Carbon::now();
        // You can format the date as well
        // $formattedDate = $currentDate->format('Y-m-d');
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
                'date' => $request->input('date', null),
                'created_by' => Auth::user()->id,
            ]
        );
        $message = $id ? 'Updated successfully' : 'Submitted successfully';
        Session::flash('message', $message);
        $roles = get_roles();
        if (!in_array('super_admin', $roles)) {
            if ($validatedData['type'] == 4 || $validatedData['type'] == 5) {
                return redirect()->route('system_manual.signature-uat')->with('success', 'Data saved successfully!');
            }
            return redirect()->route('system_manual.index')->with('success', 'Data saved successfully!');
        } else {
            return redirect()->route('system_manual.index')->with('success', 'Data saved successfully!');
        }
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

    public function receipt_goods_edit($id)
    {
        // Retrieve the record
        $systemManual = $this->systemManual->findOrFail($id);

        // Ensure you pass the list of equipment and the current data
        $data = [
            'systemManual' => $systemManual,
            'equipmentsList' => $this->systemManual->getEquipmentList(),
        ];

        return view('pages.system_manual.ReceiptOfGoodsEdit', $data);
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
    public function getSystemManualList(Request $request)
    {
        // Query the database with a join to the 'equipments' table
        $roles = get_roles();
        if (in_array('institute', $roles)) {
            $query = DB::table('system_manual')
                ->join('equipments', 'system_manual.equipment_id', '=', 'equipments.id', 'left')
                ->select(
                    'system_manual.id as id',
                    'equipments.equipment as equipment_name',
                    'system_manual.document_title as document_title',
                    'system_manual.document_description as document_description',
                    'system_manual.document_file as document_file',
                    'system_manual.type as type',
                    'system_manual.no_of_page as no_of_page'
                )
                ->where('system_manual.display', '0')
                ->where('system_manual.created_by', Auth::id()); // Shortcut for Auth::user()->id
        } else if (in_array('vendor', $roles)) {
            $query = DB::table('system_manual')
                ->join('equipments', 'system_manual.equipment_id', '=', 'equipments.id', 'left')
                ->select(
                    'system_manual.id as id',
                    'equipments.equipment as equipment_name',
                    'system_manual.document_title as document_title',
                    'system_manual.document_description as document_description',
                    'system_manual.document_file as document_file',
                    'system_manual.type as type',
                    'system_manual.no_of_page as no_of_page'
                )
                ->where('system_manual.display', '0')
                ->where('system_manual.created_by', Auth::id()); // Shortcut for Auth::user()->id

        } else {
            $query = DB::table('system_manual')
                ->join('equipments', 'system_manual.equipment_id', '=', 'equipments.id', 'left')
                ->join('users', 'system_manual.created_by', '=', 'users.id', 'left') // Join with the equipment table
                ->select(
                    'system_manual.id as id',
                    'equipments.equipment as equipment_name',
                    'system_manual.document_title as document_title',
                    'system_manual.document_description as document_description',
                    'system_manual.document_file as document_file',
                    'system_manual.type as type',
                    'system_manual.no_of_page as no_of_page',
                    'users.name as vendor',
                )
                ->where('system_manual.display', '0');
        }

        // Process data for DataTables
        return datatables()
            ->query($query) // Use the 'query' method for raw DB queries

            ->addColumn('vendor', function ($row) {
                return $row->vendor ?? 'N/A'; // Assuming the `Equipment` model has a `name` field
            })

            ->addColumn('type', function ($row) {
                return $row->type == 1 ? 'System Manual' : ($row->type == 2 ? 'Lab Implemention Document' : ($row->type == 3 ? 'UAT Document' : 'UAT Signature'));
            })
            ->addColumn('document_file', function ($row) {
                return $row->document_file
                    ? '<a href="' . asset('storage/' . $row->document_file) . '" class="btn btn-sm btn-primary" target="_blank">Doc</a>'
                    : 'N/A';
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('system_manual.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['document_file', 'action'])
            ->make(true);
    }
    public function getSystemManuals(Request $request)
    {
        return DataTables::of(SystemManual::query())
            ->filter(function ($query) use ($request) {
                if ($request->has('typeFilter') && $request->type != '0') {
                    $query->where('type', $request->type);
                }
            })
            ->make(true);
    }
    // public function getSystemManuals(Request $request)
    // {
    //     $query =
    //         $this->systemManual->newQuery()
    //         ->leftjoin('equipments', 'system_manual.equipment_id', '=', 'equipments.id') // Join with the equipment table
    //         ->select([
    //             'system_manual.id',
    //             'system_manual.document_title',
    //             'system_manual.document_file',
    //             'system_manual.type',
    //             'system_manual.no_of_page',
    //             'system_manual.date',
    //             'equipments.equipment as equipment_name', // Select the equipment name from the joined table
    //         ])->where('system_manual.type', '!=', '4')->where('system_manual.type', '!=', '5')->where('system_manual.display', 0)->orderBy('system_manual.id', 'DESC');

    //     if ($request->has('type') && $request->type != '0') {
    //         $query->where('type', $request->type);
    //     }

    //     return DataTables::of($query)->make(true);
    // }
}
