<?php

namespace App\Http\Controllers;

use App\Models\{ProjectTimeline,Equipment,VendorInstitute,Institute,Zone};
use Illuminate\Http\Request;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectTimelineController extends Controller
{

     /**
     * Display all listing of the project timelines for admin end
     */

    public function projects_timeline(Request $request) {

        $equipments = Equipment::select(['id', 'equipment'])->orderBy('equipment', 'ASC')->get();
        $zones = Zone::select(['id', 'zone'])->orderBy('zone', 'ASC')->get();

        $zone_id = $request->zone_id ?? '';
        $inst_id = $request->inst_id ?? '';
        $institutes = [];

        if ($zone_id) {
	
	    if (in_array('lsa', get_roles())) {
                $institutes = DB::SELECT("SELECT `id`, `institute` FROM `" . DB::getTablePrefix() . "institutes` WHERE `id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "lsa_institute` WHERE `user_id` = " . current_user_id() . " AND `institute_id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `zone_id` = $zone_id)))");
            } else if (in_array('nodal', get_roles())) {

                $lsa_users = DB::table('nodal_lsas')->select('lsa_id')->where('nodal_user_id', current_user_id())->get()->toArray();
                $lsa_ids = array_column($lsa_users, 'lsa_id');

                $institutes = DB::SELECT("SELECT `id`, `institute` FROM `" . DB::getTablePrefix() . "institutes` WHERE `id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "lsa_institute` WHERE `user_id` IN (" . implode (',', $lsa_ids) . ") AND `institute_id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `zone_id` = $zone_id)))");


            } else {
                $institutes = DB::SELECT("SELECT `id`, `institute` FROM `" . DB::getTablePrefix() . "institutes` WHERE `id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `zone_id` = $zone_id))");
            }

            //$institutes = DB::SELECT("SELECT `id`, `institute` FROM `" . DB::getTablePrefix() . "institutes` WHERE `id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `zone_id` = $zone_id))");
        }

        $response = [];
        if ($inst_id) {
            $project_timeline = ProjectTimeline::where('institute_id', $inst_id)->get();
            foreach ($project_timeline as $p_timeline) {
                $response[$p_timeline->equipment_id] = $p_timeline->toArray();
            }
        }
        
        return view('pages.project_timeline.list', compact('equipments', 'institutes', 'response', 'zones'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        //abort_if((! in_array('vendor', get_roles())), 403, __('app.permission_denied'));

        $equipments = Equipment::select(['id', 'equipment'])->orderBy('equipment', 'ASC')->get();
        $institutes = VendorInstitute::
                        select(['institutes.id', 'institutes.institute'])
                        ->leftJoin('institutes', 'vendor_zone_institutes.institute_id', '=', 'institutes.id')
                        ->leftJoin('vendor_zones', 'vendor_zone_institutes.vendor_zone_id', '=', 'vendor_zones.id')
                        ->leftJoin('zones', 'vendor_zones.zone_id', '=', 'zones.id')
                        ->where('vendor_zones.vendor_id', \Auth::user()->id)
                        ->orderBy('institutes.institute', 'ASC')
                        ->get();


        $institute_id = $request->get('inst_id');
        $schedule_equipments = [];
        $schedule_equipments_arr = [];
        if ($institute_id)
             {
                try 
                    {
                        $inst_id = Crypt::decrypt($institute_id);
                        $schedule_equipments = ProjectTimeline::
                                                select(['equipments.id', 'equipments.equipment', 'project_timelines.equipment_dispatch_date',  'project_timelines.equipment_delivery_date', 'project_timelines.equipment_dispatch_date', 'project_timelines.equipment_install_date', 'project_timelines.equipment_commision_date', 'project_timelines.dispatch_invoice_file', 'project_timelines.id AS pt_id', 'project_timelines.equipment_delivered_date', 'project_timelines.equipment_installed_date', 'project_timelines.equipment_commisioned_date'])
                                                ->leftJoin('equipments', 'project_timelines.equipment_id', '=', 'equipments.id')
                                                ->where('project_timelines.institute_id', $inst_id)
                                                ->orderBy('project_timelines.equipment_dispatch_date', 'ASC')
                                                ->get();
                        $schedule_equipments_arr = array_column($schedule_equipments->toArray(), 'id');
                    }
                catch (\Exception $e) 
                    {

                    }
             }

        return view('pages.project_timeline.create', compact('equipments', 'institutes', 'schedule_equipments', 'schedule_equipments_arr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                                'institute_id' => 'required',
                                'equipments' => 'required',
                                //'dispatch_date' => 'required',
                                'delivery_date' => 'required|date|after_or_equal:dispatch_date',
                                'installation_date' => 'required|date|after_or_equal:delivery_date',
                                'commission_date' => 'required|date|after_or_equal:installation_date',
                                //'dispatch_pdf' => 'required|mimes:pdf|max:10240',
                          ]);

        $institute_id = $request->inst_id;
        try 
            {
                $inst_id = Crypt::decrypt($institute_id);
            }
        catch (\Exception $e) 
            {
                abort_if(!0, 403);
            }

        DB::beginTransaction();

        try 
            {
                $status = 'success';
                foreach($request->equipments as $equipment_id)
                    {
                        $equipment_id = Crypt::decrypt($equipment_id);

                        ProjectTimeline::create([
                                    'institute_id' => $inst_id,
                                    'equipment_id' => $equipment_id,
                                    //'equipment_dispatch_date' => $request->dispatch_date, 
                                    'equipment_delivery_date' => $request->delivery_date, 
                                    'equipment_install_date' => $request->installation_date , 
                                    'equipment_commision_date' => $request->commission_date,
                                    //'dispatch_invoice_file' => $client_original_file_name
                                ]);
                    }
                
                DB::commit();
            }

        catch (\Exception $e) {
            DB::rollback();
            $status = 'error';
            $msg = $e->getMessage();
        }

        $redirect_url = route('project_timeline') . '?inst_id=' . $request->inst_id;

        return redirect($redirect_url)->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectTimeline $projectTimeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectTimeline $projectTimeline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectTimeline $projectTimeline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectTimeline $projectTimeline)
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function inst_create(Request $request)
    {
        //
        //abort_if((! in_array('institute', get_roles())), 403, __('app.permission_denied'));

        abort_if((! in_array('institute', get_roles())), 403, __('app.permission_denied'));

        $equipments = Equipment::select(['id', 'equipment'])->orderBy('equipment', 'ASC')->get();
        $inst_id = get_vendor_inst_id();

        $schedule_equipments = ProjectTimeline::
                                                select(['equipments.id', 'equipments.equipment', 'project_timelines.equipment_dispatch_date',  'project_timelines.equipment_delivery_date', 'project_timelines.equipment_dispatch_date', 'project_timelines.equipment_install_date', 'project_timelines.equipment_commision_date', 'project_timelines.id AS pt_id', 'project_timelines.equipment_actual_dispatch_date', 'project_timelines.dispatch_invoice_file', 'project_timelines.equipment_delivered_date', 'project_timelines.equipment_installed_date', 'project_timelines.upload_pdf', 'project_timelines.equipment_commisioned_date'])
                                                ->leftJoin('equipments', 'project_timelines.equipment_id', '=', 'equipments.id')
                                                ->where('project_timelines.institute_id', $inst_id)
                                                ->orderBy('project_timelines.equipment_dispatch_date', 'ASC')
                                                ->get();

	/* get vendor information */
        $mapped_inst_id = get_vendor_inst_id();

        $get_vendor_info = DB::SELECT("SELECT `id`, `name` FROM `" . DB::getTablePrefix() . "users` WHERE `id` = (SELECT `vendor_id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `id` = (SELECT `vendor_zone_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `institute_id` = $mapped_inst_id))");
	$get_inst_info = DB::SELECT("SELECT `id`, `institute` FROM `" . DB::getTablePrefix() . "institutes` WHERE `id` = (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "user_institutes` WHERE `user_id` = " . current_user_id() .")");

        $vendor_name = 'N/A';
	$inst_name = 'N/A';

        if (isset($get_vendor_info[0]->name))
        $vendor_name = $get_vendor_info[0]->name;

	if (isset($get_inst_info[0]->institute))
        $inst_name = $get_inst_info[0]->institute;

        /* close */

        return view('pages.project_timeline.inst_create', compact('equipments', 'schedule_equipments', 'vendor_name', 'inst_name'));
    }

    public function inst_equipment_data(Request $request) 
        {
            $institute_id = get_vendor_inst_id();

            $delivered_date = $request->delivered_date;
            $installed_date = $request->installed_date;
            $commissioned_date = $request->commissioned_date;

            DB::beginTransaction();

            try 
                {
                    $status = 'success';
                    foreach(explode(',', $request->equipments) as $equipment) 
                        {
                            $equipment_id = Crypt::decrypt($equipment);
                            ProjectTimeline::where(['equipment_id' => $equipment_id, 'institute_id' => $institute_id])->update(['equipment_delivered_date' => $delivered_date, 'equipment_installed_date' => $installed_date , 'equipment_commisioned_date' => $commissioned_date]);
                        }
                    
                    DB::commit();
                }

            catch (\Exception $e) {
                DB::rollback();
                $status = 'error';
                $msg = $e->getMessage();
            }

            return response()->json(compact('status'));
        }


    public function updateSchedultEquipments(Request $request) {

        $schedule_id = $request->schedule_id;
        $actual_dispatch_date = $request->actual_dispatch_date;
        try 
            {
                $schedule_id = Crypt::decrypt($schedule_id);
                ProjectTimeline::where('id', $schedule_id)->update(['equipment_actual_dispatch_date' => $actual_dispatch_date]);
                $status = true;
                \Session::flash('message', 'Update Successfully'); 
            }
        catch (\Exception $e) 
            {
                $status = false;
            }
        return response()->json(compact('status'));
    }

   public function updateDispatchInfo(Request $request) {

        $request->validate([
                                'dispatch_date' => 'required',
                                'dispatch_pdf' => 'required|mimes:pdf|max:10240',
                          ]);

        $pt_id = $request->pt_id;
        $dispatch_date = $request->dispatch_date;
        try 
            {
                $pt_id = Crypt::decrypt($pt_id);
                $client_original_file_name = '';
                if ($request->hasFile('dispatch_pdf')) {
                        $file = $request->file('dispatch_pdf');
                        $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('public/uploads/', $client_original_file_name);
                }

                ProjectTimeline::where('id', $pt_id)->update(['equipment_dispatch_date' => $dispatch_date, 'dispatch_invoice_file' => $client_original_file_name]);
                $status = true;
                \Session::flash('message', 'Update Successfully'); 
            }
        catch (\Exception $e) 
            {
                $status = false;
            }
        return response()->json(compact('status'));
    }

    public function updateScheduledEquipmentAction(Request $request) {

        $action_id = $request->p_action_id;

        $validate = [];
        $update_arr = [];

        switch ($action_id) {
            case 1:
                    $validate['delivered_date'] = 'required|date';
                    $update_arr = ['equipment_delivered_date' => $request->delivered_date];
                    break;

            case 2:
                    $validate['installed_date'] = 'required|date';
                    $update_arr = ['equipment_installed_date' => $request->installed_date];
                    break;

            case 3:
                    $validate['commissioned_date'] = 'required|date';
                    $update_arr = ['equipment_commisioned_date' => $request->commissioned_date];
                    break;
        }

        $request->validate($validate);

        $pt_id = $request->pro_time_id;
        try 
            {
                $pt_id = Crypt::decrypt($pt_id);
                ProjectTimeline::where('id', $pt_id)->update($update_arr);
                $status = true;
                \Session::flash('message', 'Update Successfully'); 
            }
        catch (\Exception $e) 
            {
                $status = false;
            }
        return response()->json(compact('status'));
    }

    public function updateScheduledEquipmentUpload(Request $request) {

        $request->validate(['upload_pdf' => 'required|mimes:pdf|max:10240']);

        $pt_id = $request->ptl_id;
        try 
            {
                $pt_id = Crypt::decrypt($pt_id);
                $client_original_file_name = '';
                if ($request->hasFile('upload_pdf')) {
                        $file = $request->file('upload_pdf');
                        $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('public/uploads/', $client_original_file_name);
                }

                ProjectTimeline::where('id', $pt_id)->update(['upload_pdf' => $client_original_file_name]);
                $status = true;
                \Session::flash('message', 'Update Successfully'); 
            }
        catch (\Exception $e) 
            {
                $status = false;
            }
        return response()->json(compact('status'));
    }
}
