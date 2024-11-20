<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Equipment,Institute,VendorInstitute,UserInstitute,Zone};

use Illuminate\Support\Facades\DB;

use App\DataTables\WorkShopDataTable;

class DashboardController extends Controller
{
    //
    public function index() {


        // $res = DB::table('institutes')->orderBy('id', 'ASC')->get();
        // $user_id = 10;

        // $pwd = 'Pwd@#12';
        //     $password = '';//bcrypt($pwd);


        // foreach($res as $rest) {

        //     //list($name, $email1) = explode('@', $rest->email);
            

        //     echo "INSERT INTO `tcil_users` SET `name` = '$rest->contact_person', `email` = '" . $rest->email . "', `password` = '$password', `created_at` = '".date("Y-m-d H:i:s")."', `updated_at` = '".date("Y-m-d H:i:s")."';";
        //     echo "<br />";

        //    // echo "INSERT INTO `tcil_role_users` SET `role_id` = 3, `user_id` = (SELECT `id` FROM `tcil_users` ORDER BY `id` DESC LIMIT 1), `created_at` = '".date("Y-m-d H:i:s")."', `updated_at` = '".date("Y-m-d H:i:s")."';";
        //    // echo "<br />";

        //     //echo "INSERT INTO `tcil_user_institutes` SET `user_id` = (SELECT `id` FROM `tcil_users` ORDER BY `id` DESC LIMIT 1), `institute_id` =  $rest->id;";
        //     echo "<br />";
        //     echo "<br />";
        //     echo "<br />";


        //     $user_id++;

        // }

        // die;


	$response = '';
        $roles = get_roles();

	if (in_array('lsa', $roles) OR in_array('nodal', $roles)) {
            return redirect()->route('institutes.index'); 
        }


	if(current_user_id() == 1656)
        return redirect()->route('telecom.dashboard'); 


        if(in_array('bsnl-admin', $roles))
        return redirect()->route('poc_bsnl.index'); 
            
        if(in_array('super_admin', $roles) OR in_array('doit', $roles) OR in_array('admin_view', $roles)) {
            $dashboard = 'pages.dashboard.super_admin';
            $response = $this->adminDashboard($dashboard);
        }

        elseif(in_array('vendor', $roles)) {
            $dashboard = 'pages.dashboard.vendor';
            $response = $this->vendorDashboard($dashboard);
        }
    
        elseif(in_array('institute', $roles)) {
            $dashboard = 'pages.dashboard.institute';
            $response = $this->instituteDashboard($dashboard);
        }

        elseif(in_array('bsnl-admin', $roles)) {
            $dashboard = 'pages.dashboard.bsnl_user';
        }

	elseif(in_array('user', $roles) OR in_array('bsnl-user', $roles) OR in_array('expert-user', $roles) OR in_array('six-g-user', $roles)) {
            $dashboard = 'pages.dashboard.user';
        }

	elseif(in_array('project_manager', $roles)) {
            return redirect()->route('telecom.dashboard'); 
        }


        /*elseif(in_array('bsnl-user', $roles)) {
            return redirect()->route('poc_bsnl.index');
        }
        
        elseif(in_array('expert-user', $roles)) {
            return redirect()->route('expert_user.index');
        }
        
        elseif(in_array('six-g-user', $roles)) {
            return redirect()->route('six_g_user.index');
        }*/

        
        return view($dashboard, compact('response'));
    }


    private function arrContextOptions() {
        return  array(
                        "ssl" => array(
                            "verify_peer"=>false,
                            "verify_peer_name"=>false,
                        ),
                     );  
    }

    public function futureTechExperts() {

        $users_res = json_decode(file_get_contents('https://bharat5glabs.gov.in/api/form3', false, stream_context_create($this->arrContextOptions())));
        $users = $users_res->data;
        $path = $users_res->url;

        return view('pages.future_tech_experts', compact('users', 'path'));
    }

    public function futureTechExpertsSummary(Request $request, $id = '') {

        $users_res = json_decode(file_get_contents('https://bharat5glabs.gov.in/api/form3/' . $id, false, stream_context_create($this->arrContextOptions())));

        $user = $users_res->data[0];
        $path = $users_res->url;

        return view('pages.future_tech_expert_summary', compact('user', 'path'));
    }

    public function adminDashboard($view = '') {
        $ticket_data = '';
        $lab_status_arr = '';

	$six_g_total = DB::table('6g_applications')->where('is_form_submit', 1)->count();
        $expert_total = DB::table('ask_expert_details')->count();
        $poc_bsnl_total = DB::table('poc_bsnls')->count();


	$total_6g_application = DB::table('6g_applications')->count();
        $submit_6g_application = DB::table('6g_applications')->where('is_form_submit', 1)->count();


        $stats = DB::SELECT("SELECT i.institute,                    
                                        SUM(
                                                CASE WHEN pt.equipment_delivery_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS delivered,

                                        SUM(
                                                CASE WHEN pt.equipment_install_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS installed,

                                        SUM(
                                                CASE WHEN pt.equipment_commision_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS commissioned,

                                        SUM(
                                                CASE WHEN (pt.equipment_delivery_date >= pt.equipment_delivered_date AND equipment_delivered_date IS NOT NULL)  THEN 1 ELSE 0
                                        END) AS equipment_delivered_on_time,

                                        SUM(
                                                 CASE WHEN (pt.equipment_install_date >= pt.equipment_installed_date AND equipment_installed_date IS NOT NULL) THEN 1 ELSE 0
                                        END) AS equipment_installed_on_time,

                                        SUM(
                                                 CASE WHEN (pt.equipment_commision_date >= pt.equipment_commisioned_date AND pt.equipment_installed_date IS NOT NULL) THEN 1 ELSE 0
                                        END) AS equipment_commision_on_time FROM `" . DB::getTablePrefix() . "project_timelines` as pt left join `" . DB::getTablePrefix() . "institutes` as i ON i.id = pt.institute_id GROUP BY pt.institute_id");

        $eq_stats = DB::SELECT("SELECT                  
                                        SUM(
                                                CASE WHEN pt.equipment_delivery_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS delivered,

                                        SUM(
                                                CASE WHEN pt.equipment_install_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS installed,

                                        SUM(
                                                CASE WHEN pt.equipment_commision_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS commissioned

                                        FROM `" . DB::getTablePrefix() . "project_timelines` AS pt")[0];


        $eq_stats = DB::SELECT("SELECT                  
                                        SUM(
                                                CASE WHEN pt.equipment_delivery_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS delivered,

                                        SUM(
                                                CASE WHEN pt.equipment_install_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS installed,

                                        SUM(
                                                CASE WHEN pt.equipment_commision_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS commissioned

                                        FROM `" . DB::getTablePrefix() . "project_timelines` AS pt")[0];

        $pr_stats = DB::SELECT("SELECT        

                                        SUM(
                                                CASE WHEN (pt.equipment_delivery_date IS NOT NULL AND pt.equipment_delivery_date > pt.equipment_delivered_date) THEN 1 ELSE 0
                                        END) AS on_time_delivered,

                                        SUM(
                                                CASE WHEN (pt.equipment_install_date IS NOT NULL AND pt.equipment_install_date > pt.equipment_installed_date) THEN 1 ELSE 0
                                        END) AS on_time_installed,

                                        SUM(
                                                CASE WHEN (pt.equipment_commision_date IS NOT NULL AND pt.equipment_commision_date > pt.equipment_commisioned_date) THEN 1 ELSE 0
                                        END) AS on_time_commisioned,

                                        SUM(
                                                CASE WHEN (pt.equipment_delivered_date IS NOT NULL AND pt.equipment_delivery_date < pt.equipment_delivered_date) THEN 1 ELSE 0
                                        END) AS delayed_time_delivered,

                                        SUM(
                                                CASE WHEN (pt.equipment_installed_date IS NOT NULL AND pt.equipment_install_date < pt.equipment_installed_date) THEN 1 ELSE 0
                                        END) AS delayed_time_installed,

                                        SUM(
                                                CASE WHEN (pt.equipment_commisioned_date IS NOT NULL AND pt.equipment_commision_date < pt.equipment_commisioned_date) THEN 1 ELSE 0
                                        END) AS delayed_time_commisioned


                                        FROM `" . DB::getTablePrefix() . "project_timelines` AS pt")[0];

        $pr_on_time_stats = $pr_stats->on_time_delivered + $pr_stats->on_time_installed + $pr_stats->on_time_commisioned;
        $pr_delayed_time_stats = $pr_stats->delayed_time_delivered + $pr_stats->delayed_time_installed + $pr_stats->delayed_time_commisioned;

        $ticket_data = DB::SELECT("SELECT
                                            COUNT(*) AS received,
                                            SUM(
                                                CASE WHEN t.status = 'open' THEN 1 ELSE 0
                                            END
                                        ) AS open,
                                        SUM(
                                            CASE WHEN t.status = 'closed' THEN 1 ELSE 0
                                        END
                                        ) AS closed,
                                        SUM(
                                            CASE WHEN t.status = 'in-progress' THEN 1 ELSE 0
                                        END
                                        ) AS in_progress
                                        FROM
                                            `tcil_tickets` AS t
                                        WHERE
                                            1")[0];

	$zones =  Zone::select('id', 'zone')->get();
        $categories_arr = [];
        $equipment_delivery_date_arr = [];
        $equipment_installed_arr = [];
        $equipment_commissioned_arr = [];
        foreach ($zones as $zone) {

            $get_institute_ids = DB::SELECT("SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `zone_id` =  " . $zone->id . ")");

            $get_inst_ids = array_column($get_institute_ids, 'institute_id');
            array_push($get_inst_ids, -1);

            $get_inst_ids_comma_sep = implode(',', $get_inst_ids);

            $zstats = DB::SELECT("SELECT                   
                                    SUM(
                                            CASE WHEN pt.equipment_delivery_date IS NOT NULL THEN 1 ELSE 0
                                    END) AS delivered,

                                    SUM(
                                            CASE WHEN pt.equipment_install_date IS NOT NULL THEN 1 ELSE 0
                                    END) AS installed,

                                    SUM(
                                            CASE WHEN pt.equipment_commision_date IS NOT NULL THEN 1 ELSE 0
                                    END) AS commissioned

                                    FROM `" . DB::getTablePrefix() . "project_timelines` as pt WHERE pt.institute_id IN ($get_inst_ids_comma_sep)")[0];

            $categories_arr[] = $zone->zone;
            $equipment_delivery_date_arr[] = $zstats->delivered;
            $equipment_installed_arr[] = $zstats->installed;
            $equipment_commissioned_arr[] = $zstats->commissioned;
	}


        return compact('ticket_data', 'lab_status_arr', 'six_g_total', 'expert_total', 'poc_bsnl_total', 'stats', 'eq_stats', 'pr_on_time_stats', 'pr_delayed_time_stats', 'total_6g_application', 'submit_6g_application', 'categories_arr', 'equipment_delivery_date_arr', 'equipment_installed_arr', 'equipment_commissioned_arr');
    }

    public function vendorDashboard($view = '') {

        $current_user_id = current_user_id();

        /* Lab Status */
        $lab_status_data = DB::SELECT("SELECT SUM(CASE WHEN equipment_delivery_date IS NOT NULL THEN 1 ELSE 0 END) AS supplied, SUM(CASE WHEN equipment_installed_date IS NOT NULL THEN 1 ELSE 0 END) AS installation, SUM(CASE WHEN equipment_install_date IS NOT NULL THEN 1 ELSE 0 END) AS commissioned FROM `" . DB::getTablePrefix() . "project_timelines` WHERE `institute_id` IN(SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `vendor_id` = $current_user_id))")[0];
        /* Close */

        $lab_status_arr = [];
        foreach ((array) $lab_status_data as $key => $stat_count) {
            $lab_status_arr[] = ['name' => ucfirst($key), 'y' => (int) $stat_count];
        }

	$get_institute_ids = DB::SELECT("SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `vendor_id` =  " . $current_user_id . ")");

        $get_inst_ids = array_column($get_institute_ids, 'institute_id');

	$stats = DB::SELECT("SELECT i.institute,                    
                                        SUM(
                                                CASE WHEN pt.equipment_delivery_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS delivered,

                                        SUM(
                                                CASE WHEN pt.equipment_install_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS installed,

                                        SUM(
                                                CASE WHEN pt.equipment_commision_date IS NOT NULL THEN 1 ELSE 0
                                        END) AS commissioned,

                                        SUM(
                                                CASE WHEN (pt.equipment_delivery_date >= pt.equipment_delivered_date AND equipment_delivered_date IS NOT NULL)  THEN 1 ELSE 0
                                        END) AS equipment_delivered_on_time,

                                        SUM(
                                                 CASE WHEN (pt.equipment_install_date >= pt.equipment_installed_date AND equipment_installed_date IS NOT NULL) THEN 1 ELSE 0
                                        END) AS equipment_installed_on_time,

                                        SUM(
                                                 CASE WHEN (pt.equipment_commision_date >= pt.equipment_commisioned_date AND pt.equipment_installed_date IS NOT NULL) THEN 1 ELSE 0
                                        END) AS equipment_commision_on_time FROM `" . DB::getTablePrefix() . "project_timelines` as pt left join `" . DB::getTablePrefix() . "institutes` as i ON i.id = pt.institute_id WHERE pt.institute_id IN ( " . implode(',', $get_inst_ids). ") GROUP BY pt.institute_id");

        $ticket_data = DB::SELECT("SELECT
                                        COUNT(*) AS received,
                                        SUM(
                                            CASE WHEN t.status = 'open' THEN 1 ELSE 0
                                        END
                                    ) AS open,
                                    SUM(
                                        CASE WHEN t.status = 'closed' THEN 1 ELSE 0
                                    END
                                    ) AS closed,
                                    SUM(
                                        CASE WHEN t.status = 'in-progress' THEN 1 ELSE 0
                                    END
                                    ) AS in_progress
                                    FROM
                                        `tcil_tickets` AS t
                                    WHERE `user_id` = " . current_user_id())[0];


	$pr_stats = DB::SELECT("SELECT        

                                        SUM(
                                                CASE WHEN (pt.equipment_delivery_date IS NOT NULL AND pt.equipment_delivery_date > pt.equipment_delivered_date) THEN 1 ELSE 0
                                        END) AS on_time_delivered,

                                        SUM(
                                                CASE WHEN (pt.equipment_install_date IS NOT NULL AND pt.equipment_install_date > pt.equipment_installed_date) THEN 1 ELSE 0
                                        END) AS on_time_installed,

                                        SUM(
                                                CASE WHEN (pt.equipment_commision_date IS NOT NULL AND pt.equipment_commision_date > pt.equipment_commisioned_date) THEN 1 ELSE 0
                                        END) AS on_time_commisioned,

                                        SUM(
                                                CASE WHEN (pt.equipment_delivered_date IS NOT NULL AND pt.equipment_delivery_date < pt.equipment_delivered_date) THEN 1 ELSE 0
                                        END) AS delayed_time_delivered,

                                        SUM(
                                                CASE WHEN (pt.equipment_installed_date IS NOT NULL AND pt.equipment_install_date < pt.equipment_installed_date) THEN 1 ELSE 0
                                        END) AS delayed_time_installed,

                                        SUM(
                                                CASE WHEN (pt.equipment_commisioned_date IS NOT NULL AND pt.equipment_commision_date < pt.equipment_commisioned_date) THEN 1 ELSE 0
                                        END) AS delayed_time_commisioned


                                        FROM `" . DB::getTablePrefix() . "project_timelines` AS pt WHERE pt.institute_id IN ( " . implode(',', $get_inst_ids). ")")[0];

        $pr_on_time_stats = $pr_stats->on_time_delivered + $pr_stats->on_time_installed + $pr_stats->on_time_commisioned;
        $pr_delayed_time_stats = $pr_stats->delayed_time_delivered + $pr_stats->delayed_time_installed + $pr_stats->delayed_time_commisioned;

	

        return compact('ticket_data', 'lab_status_arr', 'stats', 'pr_on_time_stats', 'pr_delayed_time_stats');
    }

    public function instituteDashboard($view = '') {

        $inst_id = UserInstitute::select('institute_id')->where('user_id', current_user_id())->first()->institute_id;

        /* Ticket Status */
        $ticket_data = DB::SELECT("SELECT
                                        COUNT(*) AS received,
                                        SUM(
                                            CASE WHEN t.status = 'open' THEN 1 ELSE 0
                                        END
                                    ) AS open,
                                    SUM(
                                        CASE WHEN t.status = 'closed' THEN 1 ELSE 0
                                    END
                                    ) AS closed,
                                    SUM(
                                        CASE WHEN t.status = 'in-progress' THEN 1 ELSE 0
                                    END
                                    ) AS in_progress
                                    FROM
                                        `tcil_tickets` AS t
                                    WHERE (`user_id` = " . current_user_id() ."  OR `institute_id` = " . $inst_id . ")")[0];
        /* Close */

        /* Lab Status */

        $lab_status_data = DB::SELECT("SELECT SUM(CASE WHEN equipment_delivery_date IS NOT NULL THEN 1 ELSE 0 END) AS supplied, SUM(CASE WHEN equipment_delivered_date IS NOT NULL THEN 1 ELSE 0 END) AS installation, SUM(CASE WHEN equipment_install_date IS NOT NULL THEN 1 ELSE 0 END) AS commissioned FROM `" . DB::getTablePrefix() . "project_timelines` WHERE `institute_id` = $inst_id")[0];
        /* Close */

        $lab_status_arr = [];
        foreach ((array) $lab_status_data as $key => $stat_count) {
            $lab_status_arr[] = ['name' => ucfirst($key), 'y' => (int) $stat_count];
        }

        return compact('ticket_data', 'lab_status_arr');
    }


    public function lab_status() {
        $equipments = Equipment::all();
        return view('pages.lab_status.create', compact('equipments'));
    }

    public function assignment() {
        $equipments = Equipment::all();
        $institutes = Institute::select('institutes.*')
                    ->rightJoin('vendor_zone_institutes', 'institutes.id', '=', 'vendor_zone_institutes.institute_id')
                    ->join('vendor_zones', 'vendor_zone_institutes.vendor_zone_id', '=', 'vendor_zones.id')
                    ->where('vendor_zones.vendor_id', current_user_id())->get();
        return view('pages.equipment_assignment.create', compact('equipments', 'institutes'));
    }


    public function assignment_store(Request $request) {

        $request->validate([
                                'date' => 'required',
                                'equipments' => 'required|array',
                                'equipments.*' => 'required',

                                'institute' => 'required|array',
                                'institute.*' => 'required',
                          ]);

        DB::beginTransaction();

        try {

            $vendor_equipment_info_id = DB::table('vendor_equipment_info')->insertGetId(['vendor_id' => \Auth::user()->id, 'assign_date' => $request->date]);

            foreach ($request->equipments as $equipment_id) {

                foreach ($request->institute as $ins_id) {

                    DB::table('vendor_equipment_institurtes')->insert(['vendor_equipment_info_id' => $vendor_equipment_info_id, 'equipment_id' => $equipment_id, 'institute_id' => $ins_id]);
                }
            }
            DB::commit();
        }

        catch (\Exception $e) {
            DB::rollback();
            $key = 'error';
            $msg = $e->getMessage();
        }

        return redirect()->route('assignment')->with($key ?? 'message', $msg ?? 'Assigned Successfully'); 
    }


    public function sixGResearchProposals() {

        $users_res = json_decode(file_get_contents('https://bharat5glabs.gov.in/api/sixGForm', false, stream_context_create($this->arrContextOptions())));
        $users = $users_res->data;
        $path = $users_res->url;

        return view('pages.6g_research_proposals', compact('users', 'path'));
    }

    public function sixGResearchProposalSummary(Request $request, $id = '') {

        $users_res = json_decode(file_get_contents('https://bharat5glabs.gov.in/api/sixGForm/' . $id, false, stream_context_create($this->arrContextOptions())));

        $user = $users_res->data[0];
        $path = $users_res->url;

        return view('pages.6g_research_proposals_summary', compact('user', 'path'));
    }

    public function workshops(WorkShopDataTable $dataTable)
      {
          return $dataTable->render('pages.workshop.index');
      }

    
}
