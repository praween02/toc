<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\LabStatus;
use App\Models\EquipmentStatus;
class LabStatusController extends Controller
{

    const SUPPLY_PATH = 'public/uploads';
    const INSTALLATION_PATH = 'public/uploads';
    const TESTING_PATH = 'public/uploads';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipments = Equipment::all();
        return view('pages.lab_status.create', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       // abort_if(permission('lab_status.create'), 403, __('app.permission_denied'));
       $request->validate($this->validationArray());
       $post_data = $this->getPostData($request);

        try {
            $data = LabStatus::create($post_data);

            $equipments = $request->equipments;

            foreach ($equipments as $equipment) {
             EquipmentStatus::create([
                 'equipment_id' => $equipment,
                 'lab_status_id' => $data['id']
             ]);
         }

        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('lab_status.index')->with($key ?? 'message', $msg ?? 'Added Successfully');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getPostData(Request $request) {

        $supply_pdf = time() . "-tcil." . $request->supply->extension();
        $request->supply->storeAs(self::SUPPLY_PATH,$supply_pdf);
 
        $installation_pdf = time() . "-tcil." . $request->installation->extension();
        $request->installation->storeAs(self::INSTALLATION_PATH,$installation_pdf);
 
        $uat_testing_pdf = time() . "-tcil." . $request->uat_testing->extension();
        $request->uat_testing->storeAs(self::TESTING_PATH,$uat_testing_pdf);

        return [
         
        'supply_path' => $supply_pdf, 
        'installation_path' => $installation_pdf, 
        'testing_path' =>   $uat_testing_pdf,
        'training_course' => $request->training_course ?? ''
        ];
    }

    private function validationArray() {
        return [
                    'equipments' => 'required|array|max:96',
                    'supply' => 'required|mimes:pdf|max:2048',
                    'installation' => 'required|mimes:pdf|max:2048',
                    'uat_testing' => 'required|mimes:pdf|max:2048',
                    'training_course' => 'required|max:96',
                ];
    }
}
