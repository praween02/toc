<?php

namespace App\Http\Controllers;

use App\Models\{TelecomProject,TelecomDepartment};
use Illuminate\Http\Request;
use App\DataTables\TelecomDataTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;

class TelecomController extends Controller
{
    /**
     * Telecom dashboard
     */
    
    public function dashboard(TelecomDataTable $dataTable)
    {

       // echo bcrypt('dot@123'); die;


        abort_if((count(array_intersect(['project_manager', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
        // $current_user_id = current_user_id();

        // if (in_array('super_admin', get_roles())) {
        //     $this->data['projects'] = TelecomProject::count();
        //     $this->data['total_costs'] = (int) TelecomProject::select(DB::raw("SUM(cost) as total_costs"))->first()->total_costs;
        // } else {
        //     $this->data['projects'] = TelecomProject::where('user_id', $current_user_id)->count();
        //     $this->data['total_costs'] = (int) TelecomProject::select(DB::raw("SUM(cost) as total_costs"))->where('user_id', $current_user_id)->first()->total_costs;
        // }


        

        if (in_array('super_admin', get_roles())):

        $departments = TelecomDepartment::select('id', 'department')->get();

        foreach($departments as $department) {

            $total_projects_query =  DB::SELECT("SELECT COUNT(id) AS count FROM `" . DB::getTablePrefix() . "telecom_projects` WHERE `user_id` IN(SELECT `user_id` FROM `" . DB::getTablePrefix() . "user_telecom_departments` WHERE `department_id` = " . $department->id . ")");

            $total_projects = (int) $total_projects_query[0]->count;

            $project_cost_query =  DB::SELECT("SELECT SUM(cost) AS cost FROM `" . DB::getTablePrefix() . "telecom_projects` WHERE `user_id` IN(SELECT `user_id` FROM `" . DB::getTablePrefix() . "user_telecom_departments` WHERE `department_id` = " . $department->id . ")");

            $project_cost = (int) $project_cost_query[0]->cost;

            $resp[$department->department] = ['total' => $total_projects, 'cost' => $project_cost];

            $total_projects_arr[] = ['name' => $department->department, 'y' => $total_projects];
            $total_costs_arr[] = ['name' => $department->department, 'y' => $project_cost];


            $distinct_core_tech = DB::table('telecom_projects')->select('core_technology')->groupBy('core_technology')->get();

            foreach($distinct_core_tech as $core) {

                $stats =  DB::SELECT("SELECT COUNT(id) AS count FROM `" . DB::getTablePrefix() . "telecom_projects` WHERE `user_id` IN(SELECT `user_id` FROM `" . DB::getTablePrefix() . "user_telecom_departments` WHERE `department_id` = " . $department->id . ") AND `core_technology` = '".$core->core_technology."'");
                $stats_arr[$department->department][$core->core_technology] = $stats[0]->count;
            }
        }

        else:

            $departments = TelecomDepartment::select('telecom_departments.id', 'telecom_departments.department')
                                            ->leftJoin('user_telecom_departments', 'telecom_departments.id', '=', 'user_telecom_departments.department_id')->where('user_telecom_departments.user_id', current_user_id())->get();

            foreach($departments as $department) {

                $total_projects_query =  DB::SELECT("SELECT COUNT(id) AS count FROM `" . DB::getTablePrefix() . "telecom_projects` WHERE `user_id` = " . current_user_id());

                $total_projects = (int) $total_projects_query[0]->count;

                $project_cost_query =  DB::SELECT("SELECT SUM(cost) AS cost FROM `" . DB::getTablePrefix() . "telecom_projects` WHERE `user_id` = " . current_user_id());

                $project_cost = (int) $project_cost_query[0]->cost;

                $resp[$department->department] = ['total' => $total_projects, 'cost' => $project_cost];

                $total_projects_arr[] = ['name' => $department->department, 'y' => $total_projects];
                $total_costs_arr[] = ['name' => $department->department, 'y' => $project_cost];


                $distinct_core_tech = DB::table('telecom_projects')->select('core_technology')->groupBy('core_technology')->get();

                foreach($distinct_core_tech as $core) {

                    $stats =  DB::SELECT("SELECT COUNT(id) AS count FROM `" . DB::getTablePrefix() . "telecom_projects` WHERE `user_id` = " . current_user_id() . " AND `core_technology` = '".$core->core_technology."'");
                    $stats_arr[$department->department][$core->core_technology] = $stats[0]->count;
                }
            }

        endif;

        return view('pages.telecom_project.dashboard', compact('resp', 'total_projects_arr', 'total_costs_arr', 'stats_arr'));
        //return $dataTable->render('pages.telecom_project.dashboard', $this->data);
    }



    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TelecomDataTable $dataTable)
    {
        abort_if((count(array_intersect(['project_manager', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $distinct_core_tech = DB::table('telecom_projects')->select('core_technology')->groupBy('core_technology')->get();

        $sel_filter = $request->filter ?? '';

        return $dataTable->render('pages.telecom_project.index', compact('distinct_core_tech', 'sel_filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if((count(array_intersect(['project_manager', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        return view('pages.telecom_project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if((count(array_intersect(['project_manager', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $request->validate([
                                'project_description' => 'required',
                                'implementing_agency' => 'required',
                                'core_technology' => 'required',
                                'cost' => 'required|max:96'
                          ]);
        try {
            TelecomProject::create(['user_id' => current_user_id(), 'project' => $request->project_description, 'implement_agency' => $request->implementing_agency, 'core_technology' => $request->core_technology, 'cost' => $request->cost, 'created_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }

        return redirect()->route('telecom.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TelecomProject $telecom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TelecomProject $telecom)
    {
        abort_if((count(array_intersect(['project_manager', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        return view('pages.telecom_project.edit', compact('telecom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TelecomProject $telecom)
    {
        //
        abort_if((count(array_intersect(['project_manager', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $request->validate([
                                'project_description' => 'required',
                                'implementing_agency' => 'required',
                                'core_technology' => 'required',
                                'cost' => 'required|max:96'
                          ]);
        try {
            $telecom->update(['project' => $request->project_description, 'implement_agency' => $request->implementing_agency, 'core_technology' => $request->core_technology, 'cost' => $request->cost, 'updated_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('telecom.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TelecomProject $institute)
    {
        //
        abort_if((count(array_intersect(['project_manager', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
    }

}
