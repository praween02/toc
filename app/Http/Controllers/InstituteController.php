<?php

namespace App\Http\Controllers;

use App\Models\{Institute,ProjectTimeline};
use Illuminate\Http\Request;
use App\DataTables\InstitutesDataTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


use DB;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(InstitutesDataTable $dataTable)
    {
        //abort_if(permission('institute.list'), 403, __('app.permission_denied'));

        return $dataTable->render('pages.institute.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(permission('institute.create'), 403, __('app.permission_denied'));

        return view('pages.institute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(permission('institute.create'), 403, __('app.permission_denied'));

        $request->validate([
                                'institute' => 'required||max:255|unique:institutes',
                                'address' => 'required',
                                'email' => 'required|email',
                                'contact_person' => 'required|max:96',
                                'contact_number' => 'required|max:96',
                          ]);
        try {
            Institute::create(['institute' => $request->institute, 'address' => $request->address, 'email' => $request->email, 'contact_person' => $request->contact_person, 'contact_number' => $request->contact_number, 'status' => $request->status, 'created_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }
        return redirect()->route('institutes.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Institute $institute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institute $institute)
    {
        abort_if(permission('institute.update'), 403, __('app.permission_denied'));

        return view('pages.institute.edit', compact('institute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institute $institute)
    {
        //
        abort_if(permission('institute.update'), 403, __('app.permission_denied'));

        $request->validate([
                                'institute' => 'required|unique:institutes,institute,' . $institute->id . '|max:255',
                                'address' => 'required',
                                'email' => 'required|email',
                                'contact_person' => 'required|max:96',
                                'contact_number' => 'required|max:96',
                          ]);
        try {
            $institute->update(['institute' => $request->institute, 'address' => $request->address, 'email' => $request->email, 'contact_person' => $request->contact_person, 'contact_number' => $request->contact_number, 'status' => $request->status, 'updated_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('institutes.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institute $institute)
    {
        //
        abort_if(permission('institute.delete'), 403, __('app.permission_denied'));
    }

    /**
     * Institute Summary
     */

    public function summary(Request $request, $encrypted_inst_id = '')
    {
        
        try {
            $inst_id = decrypt($encrypted_inst_id);
        } 
        catch (DecryptException $e) {
            abort(404);
        }

        $institute = Institute::select(['institute', 'address', 'email', 'contact_person', 'contact_number', 'state', 'designation'])->whereId($inst_id)->firstOrFail();

        /* select equipment summary */

        $equipments_timeline  =  ProjectTimeline::select(['equipments.equipment', 'equipments.id AS equipment_id', 'project_timelines.equipment_dispatch_date', 'project_timelines.equipment_delivery_date',  'project_timelines.equipment_actual_dispatch_date', 'project_timelines.equipment_install_date',  'project_timelines.equipment_commision_date', 'project_timelines.dispatch_invoice_file', 'project_timelines.equipment_delivered_date', 'project_timelines.equipment_installed_date', 'project_timelines.equipment_commisioned_date'])->leftJoin('equipments', function($join) {
                                    $join->on('project_timelines.equipment_id', '=', 'equipments.id');
                                 })->where('project_timelines.institute_id', $inst_id)->get()->toArray();

        $equipments = [];
        if (count($equipments_timeline)) {
            $equipments = array_filter(array_combine(array_column($equipments_timeline, 'equipment_id'), array_column($equipments_timeline, 'equipment')));
        }
        /* close */

        return view('pages.institute.summary', compact('institute', 'equipments_timeline', 'equipments'));
    }

}
