<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SixGUser,AssignedApplicationToExpert,ApplicationEvaluationCriteria,ApplicationEvaluationCriteriaMarks,AskExpertDetail,SixGUserCollaborator,EvaluationCommittee,ApplicationExpertRemark};
use App\DataTables\SixGApplicationsDataTable;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Log;
use Illuminate\Http\JsonResponse;

class SixGUserController extends Controller
{

    public function enableEdit(Request $request, $enc_id = '')
         {
	    abort_if((count(array_intersect(['super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            try 
            {
                $id = decrypt($enc_id);
                SixGUser::where('id', $id)->update(['is_form_submit' => 0]);                    
            } catch (DecryptException $e) {
                $key = "failure";
                $msg = 'Something Went Wrong';
            }

            return redirect()->back()->with($key ?? 'message', $msg ?? 'Changed Successfully');
         }



    /**
     * Display a states of the country.
     */

    public function states($country_id = '') {

        $states = DB::table('states')->select(['id', 'name'])->where('country_id', $country_id)->get();
        return response()->json(compact('states'));

    }

    public function cities($state_id = '') {

        $cities = DB::table('cities')->select(['id', 'name'])->where('state_id', $state_id)->get();
        return response()->json(compact('cities'));

    }

    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request, SixGApplicationsDataTable $dataTable)
    {
        abort_if((count(array_intersect(['admin_view','user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

	$total_application = DB::table('6g_applications')->count();
        $submit_application = DB::table('6g_applications')->where('is_form_submit', 1)->count();


	$teams = [];
        if ($request->app_id) {
            $app_id = Crypt::decryptString($request->app_id);
            $teams = DB::SELECT("SELECT `id`, `team` FROM `" . DB::getTablePrefix() . "evaluation_committees` WHERE `id` NOT IN (SELECT `team_id` FROM `" . DB::getTablePrefix() . "assigned_6g_application_to_expert` WHERE `application_id`  = $app_id) ORDER BY `team` ASC");
        }

        return $dataTable->render('pages.six_g_user.index', compact('total_application', 'submit_application', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
        
        $countries =  DB::table('countries')->select(['id', 'name'])->orderBy('name', 'ASC')->get();
        $application = SixGUser::where('user_id', current_user_id())->first();
        return view('pages.six_g_user.create', compact('countries', 'application'));
    }

    /**
     * Store a newly created resource in storage.
     */


    private function blockValidation($blocks = [])
        {
            $blocks_arr = [1 => 'Organization', 3 => 'Project Details', 4 => 'Product Description', 5 => 'Project Plan', 6 => 'Funding', 7 => 'Regulatory approvals'];

            $columns = [1 => 'is_block_org_submitted', 3 => 'is_block_project_details_submitted', 4 => 'is_block_prod_desc_submitted', 5 => 'is_block_proj_plan_submitted', 6 => 'is_block_funding_submitted', 7 => 'is_block_reg_approvals_submitted'];

            $blocks_array = [];
            foreach ($blocks as $block) {
                $check_record_exist = DB::table('6g_applications')->select('id')->where('user_id', current_user_id())->where($columns[$block], 1)->first();
                if (empty($check_record_exist))
                $blocks_array[] = $blocks_arr[$block];
            }
            return $blocks_array;
        }

    private function validationBlockMsg($arr = [])
        {
            return "Please fill <strong>" . implode(", ", $arr) . "</strong> block(s) data to continue !";
        }

    // TAB 1

    public function organization(Request $request): JsonResponse
    {
        abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        Log::info("SIXG TAB 1 Entry - " . date("Y-m-d H:i:s"));

        $request->validate($this->organization_validation_array());

        $post_data = $this->org_post_data($request);

        $post_data['user_id'] = current_user_id();

        $attachment_arr = ['authorization_letter', 'bio_data_professional_credentials'];

        foreach ($attachment_arr as $key => $file_name)
            {   
                if ($request->hasFile($file_name)) {
                    $file = $request->file($file_name);
                    $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/uploads', $client_original_file_name);
                    $post_data[$file_name] = $client_original_file_name;
                }
            }

        try 
            {
                $record = SixGUser::select('id')->where('user_id', current_user_id())->first();
                if ($record):
                    SixGUser::where('user_id', current_user_id())->update($post_data);
                else:
                    $post_data['is_block_org_submitted'] = 1;
                    SixGUser::create($post_data);
                endif;
                /* end collaborator */

                $status = 'success';
                $msg = "saved";

                Session::flash('message', 'Saved successfully'); 
            } 
        catch (\Exception $e) {

            $status = 'error';
            $msg = $e->getMessage();
            \Log::info("SIXG USER ISSUE BLOCK 1 - " . $msg);
        }

        return response()->json(compact('status', 'msg'));
    }

    // TAB 2

    public function collaborator(Request $request): JsonResponse
    {
        abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $blocks_validation = $this->blockValidation([1]);
        if ($blocks_validation) {
            $msg = $this->validationBlockMsg($blocks_validation);
            return response()->json(['status' => 'validation', 'msg' => $msg]);
        }

        $app_id = SixGUser::select('id')->where('user_id', current_user_id())->first()->id;


        Log::info("SIXG TAB 2 Entry - " . date("Y-m-d H:i:s"));

        $collaborator_name_arr = $request->collaborator_name;

        DB::beginTransaction();

        try
            {
                if (count($collaborator_name_arr)):
                    $col_arr = [];
                    $col_array = [];

                    if($request->collaborator_biodata):
                        foreach ($request->collaborator_biodata as $key => $file)
                            {   
                                $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                                $file->storeAs('public/uploads', $client_original_file_name);
                                $col_arr[$key]['collaborator_biodata'] = $client_original_file_name;
                            }
                    endif;

                    if($request->collaborator_company_turnover_attachment):
                        foreach ($request->collaborator_company_turnover_attachment as $key => $file)
                            {   
                                $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                                $file->storeAs('public/uploads', $client_original_file_name);
                                $col_arr[$key]['collaborator_company_turnover_attachment'] = $client_original_file_name;
                            }
                    endif;

                    if (count($collaborator_name_arr)):
                        foreach($collaborator_name_arr as $key => $data):

                            $col_arr[$key]['application_id'] = $app_id;
                            $col_arr[$key]['collaborator_name'] = $request->collaborator_name[$key] ?? null;
                            $col_arr[$key]['collaborator_designation'] = $request->collaborator_designation[$key] ?? null;
                            $col_arr[$key]['collaborator_contact_no'] = $request->collaborator_contact_no[$key] ?? null;
                            $col_arr[$key]['collaborator_email_id'] = $request->collaborator_email_id[$key] ?? null;
                            $col_arr[$key]['collaborator_industry_cateogory'] = $request->collaborator_industry_cateogory[$key] ?? null;
                            $col_arr[$key]['collaborator_address'] = $request->collaborator_address[$key] ?? null;
                            $col_arr[$key]['collaborator_area_of_work'] = $request->collaborator_area_of_work[$key] ?? null;
                            $col_arr[$key]['collaborator_size_company'] = $request->collaborator_size_company[$key] ?? null;
                            $col_arr[$key]['collaborator_location_of_head_office_branch'] = $request->collaborator_location_of_head_office_branch[$key] ?? null;
                            $col_arr[$key]['collaborator_company_turnover'] = $request->collaborator_company_turnover[$key] ?? null;

                            if ( ! isset($col_arr[$key]['collaborator_biodata']))
                            $col_arr[$key]['collaborator_biodata'] = $request->collaborator_biodata_hidden[$key] ?? null;

                            if ( ! isset($col_arr[$key]['collaborator_company_turnover_attachment']))
                            $col_arr[$key]['collaborator_company_turnover_attachment'] =  $request->collaborator_company_turnover_attachment_hidden[$key] ?? null;

                        endforeach;

                            SixGUserCollaborator::where('application_id', $app_id)->delete();         
                            SixGUserCollaborator::insert($col_arr);   

                            DB::commit();      
                        
                    endif;
                endif;

                $status = 'success';
                $msg = 'saved';
            }
        catch (\Exception $e) {
            DB::rollback();
            $status = 'error';
            $msg = $e->getMessage();
            \Log::info("SIXG USER ISSUE BLOCK 2 - " . $msg);
        }

        return response()->json(compact('status', 'msg'));
    }

    // TAB 3

    public function project_details(Request $request): JsonResponse
        {
            abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            Log::info("SIXG TAB 3 Entry - " . date("Y-m-d H:i:s"));

            $blocks_validation = $this->blockValidation([1]);
            if ($blocks_validation) {
                $msg = $this->validationBlockMsg($blocks_validation);
                return response()->json(['status' => 'validation', 'msg' => $msg]);
            }

            $request->validate($this->project_details_validation_array());

            $post_data = $this->project_details_post_data($request);

            try 
                {
                    $post_data['is_block_project_details_submitted'] = 1;
                    SixGUser::where('user_id', current_user_id())->update($post_data);

                    $status = 'success';
                    $msg = "saved";

                    Session::flash('message', 'Saved successfully'); 
                } 
            catch (\Exception $e) {

                $status = 'error';
                $msg = $e->getMessage();
                \Log::info("SIXG USER ISSUE BLOCK 3 - " . $msg);
            }

            return response()->json(compact('status', 'msg'));
        }


    // TAB 4

    public function product_desc(Request $request): JsonResponse
        {
            abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            Log::info("SIXG TAB 4 Entry - " . date("Y-m-d H:i:s"));

            $blocks_validation = $this->blockValidation([1, 3]);
            if ($blocks_validation) {
                $msg = $this->validationBlockMsg($blocks_validation);
                return response()->json(['status' => 'validation', 'msg' => $msg]);
            }

            $request->validate($this->product_desc_validation_array());

            $post_data = $this->product_desc_post_data($request);

            $attachment_arr = ['brief_product_solution_idea_description_attachment', 'provide_the_specification_doc_relavant_to_product'];
            foreach ($attachment_arr as $key => $file_name)
                {   
                    if ($request->hasFile($file_name)) {
                        $file = $request->file($file_name);
                        $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('public/uploads', $client_original_file_name);
                        $post_data[$file_name] = $client_original_file_name;
                    }
                }

            try 
                {
                    $post_data['is_block_prod_desc_submitted'] = 1;
                    SixGUser::where('user_id', current_user_id())->update($post_data);

                    $status = 'success';
                    $msg = "saved";

                    Session::flash('message', 'Saved successfully'); 
                } 
            catch (\Exception $e) {

                $status = 'error';
                $msg = $e->getMessage();
                \Log::info("SIXG USER ISSUE BLOCK 4 - " . $msg);
            }

            return response()->json(compact('status', 'msg'));
        }

    // TAB 5

    public function project_plan(Request $request): JsonResponse
        {
            abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            Log::info("SIXG TAB 5 Entry - " . date("Y-m-d H:i:s"));

            $blocks_validation = $this->blockValidation([1, 3, 4]);
            if ($blocks_validation) {
                $msg = $this->validationBlockMsg($blocks_validation);
                return response()->json(['status' => 'validation', 'msg' => $msg]);
            }

            $request->validate($this->project_plan_validation_array());

            $post_data = $this->project_plan_post_data($request);

            $attachment_arr = ['provide_dev_plan_indicate_major_milestone_attachment', 'infrastructure_support_requirements_attachment', 'details_of_existing_tools_testers_platform_attachment'];
            foreach ($attachment_arr as $key => $file_name)
                {   
                    if ($request->hasFile($file_name)) {
                        $file = $request->file($file_name);
                        $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('public/uploads', $client_original_file_name);
                        $post_data[$file_name] = $client_original_file_name;
                    }
                }

            try 
                {
                    $post_data['is_block_proj_plan_submitted'] = 1;
                    SixGUser::where('user_id', current_user_id())->update($post_data);

                    $status = 'success';
                    $msg = "saved";

                    Session::flash('message', 'Saved successfully'); 
                } 
            catch (\Exception $e) {

                $status = 'error';
                $msg = $e->getMessage();
                \Log::info("SIXG USER ISSUE BLOCK 5 - " . $msg);
            }

            return response()->json(compact('status', 'msg'));
        }


    // TAB 6

    public function funding(Request $request): JsonResponse
        {
            abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            Log::info("SIXG TAB 6 Entry - " . date("Y-m-d H:i:s"));

            $blocks_validation = $this->blockValidation([1, 3, 4, 5]);
            if ($blocks_validation) {
                $msg = $this->validationBlockMsg($blocks_validation);
                return response()->json(['status' => 'validation', 'msg' => $msg]);
            }

            $request->validate($this->funding_validation_array());

            $post_data = $this->funding_post_data($request);

            $attachment_arr = ['estimated_development_cost_attachment', 'details_of_funding_attachment', 'details_self_funding_attachment'];
            foreach ($attachment_arr as $key => $file_name)
                {   
                    if ($request->hasFile($file_name)) {
                        $file = $request->file($file_name);
                        $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('public/uploads', $client_original_file_name);
                        $post_data[$file_name] = $client_original_file_name;
                    }
                }

            try 
                {
                    $post_data['is_block_funding_submitted'] = 1;
                    SixGUser::where('user_id', current_user_id())->update($post_data);

                    $status = 'success';
                    $msg = "saved";

                    Session::flash('message', 'Saved successfully'); 
                } 
            catch (\Exception $e) {

                $status = 'error';
                $msg = $e->getMessage();
                \Log::info("SIXG USER ISSUE BLOCK 6 - " . $msg);
            }

            return response()->json(compact('status', 'msg'));
        }

    // TAB 7

    public function regulatory(Request $request): JsonResponse
        {
            abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            Log::info("SIXG TAB 7 Entry - " . date("Y-m-d H:i:s"));

            $blocks_validation = $this->blockValidation([1, 3, 4, 5, 6]);
            if ($blocks_validation) {
                $msg = $this->validationBlockMsg($blocks_validation);
                return response()->json(['status' => 'validation', 'msg' => $msg]);
            }

            $request->validate($this->regulatory_validation_array());

            $post_data = $this->regulatory_post_data($request);

            try 
                {
                    $post_data['is_block_reg_approvals_submitted'] = 1;
                    $post_data['is_form_submit'] = 1;
                    SixGUser::where('user_id', current_user_id())->update($post_data);

                    $status = 'success';
                    $msg = "saved";

                    Session::flash('message', 'Submitted successfully'); 
                } 
            catch (\Exception $e) {

                $status = 'error';
                $msg = $e->getMessage();
                \Log::info("SIXG USER ISSUE BLOCK 7 - " . $msg);
            }

            return response()->json(compact('status', 'msg'));
        }
 
 
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $enc_id = '')
        {   
            abort_if((count(array_intersect(['admin_view', 'user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            try {
                     $application_id = Crypt::decryptString($enc_id);
                     $record = SixGUser::whereId($application_id)->first();

                } 
            catch (DecryptException $e) {
                    abort(404);
            }
            
            return view('pages.six_g_user.show', compact('record'));
        }

    
    /* TAB 1 Validation Array */

    private function organization_validation_array()
        {
            return 
                   [
                        'organization_name',
                        'nodal_contact_person',
                        'designation',
                        'authorization_letter',
                        'bio_data_professional_credentials',
                        'contact_no',
                        'email_id',
                        'country',
                        'state',
                        'city',
                        'address',
                        'pin_no',
                        'applying_as',
                    ];
        }


    private function org_post_data(Request $request) 
        {
            return 
                   [
                        'organization_name' => $request->organization_name,
                        'nodal_contact_person' => $request->nodal_contact_person,
                        'designation' => $request->designation,
                        'contact_no' => $request->contact_no,
                        'email_id' => $request->email_id,
                        'country' => $request->country,
                        'state' => $request->state,
                        'city' => $request->city,
                        'address' => $request->address,
                        'pin_no' => $request->pin_no,
                        'applying_as' => $request->applying_as,
                    ];
        }

    /* CLOSE TAB 1  */

    /* TAB 3 Validation Array */

    private function project_details_validation_array()
        {
            return 
                   [
                        'proposed_project_title',
                        'proposed_product_area_category',
                        'technology_area',
                        'stage_of_product_based_on_minimum_technology_readiness_level',
                        'collaboration_customers_clients',
                        'list_of_ipr_awards_paper_published',
                        'relevant_standards_standard_body_membership'
                    ];
        }


    private function project_details_post_data(Request $request) 
        {
            return 
                   [
                        'proposed_project_title' => $request->proposed_project_title,
                        'proposed_product_area_category' => $request->proposed_product_area_category,
                        'technology_area' => $request->technology_area,
                        'stage_of_product_based_on_minimum_technology_readiness_level' => $request->stage_of_product_based_on_minimum_technology_readiness_level,
                        'collaboration_customers_clients' => $request->collaboration_customers_clients,
                        'list_of_ipr_awards_paper_published' => $request->list_of_ipr_awards_paper_published,
                        'relevant_standards_standard_body_membership' => $request->relevant_standards_standard_body_membership,
                    ];
        }

    /* CLOSE TAB 3  */

    /* TAB 4 Validation Array */

    private function product_desc_validation_array()
        {
            return 
                   [
                        'brief_product_solution_idea_description',
                        'primary_objective_of_module_sub_system_product_solution_proposed',
                        'key_deliverables',
                        'type_of_solution_product',
                        'details_prior_experience',
                        'if_the_proposed_solution_product',
                        'is_product_tech_related_to_present_activities',
                        'is_it_new_concept_design_sol_product',
                        'are_there_any_alternate_competive_tech_product',
                    ];
        }

    private function product_desc_post_data(Request $request) 
        {
            return 
                   [
                        'brief_product_solution_idea_description' => $request->brief_product_solution_idea_description,
                        'primary_objective_of_module_sub_system_product_solution_proposed' => $request->primary_objective_of_module_sub_system_product_solution_proposed,
                        'key_deliverables' => $request->key_deliverables,
                        'type_of_solution_product' => $request->type_of_solution_product,
                        'details_prior_experience' => $request->details_prior_experience,
                        'if_the_proposed_solution_product' => $request->if_the_proposed_solution_product,
                        'is_product_tech_related_to_present_activities' => $request->is_product_tech_related_to_present_activities,
                        'is_it_new_concept_design_sol_product' => $request->is_it_new_concept_design_sol_product,
                        'are_there_any_alternate_competive_tech_product' => $request->are_there_any_alternate_competive_tech_product,
                    ];
        }

    /* CLOSE TAB 4  */

    /* TAB 5 Validation Array */

    private function project_plan_validation_array()
        {
            return 
                   [
                        'provide_dev_plan_indicate_major_milestone',
                        'provide_dev_plan_indicate_major_milestone_attachment',
                        'manpower_support_requirements',
                        'infrastructure_support_requirements',
                        'infrastructure_support_requirements_attachment',
                        'details_of_existing_tools_testers_platform',
                        'details_of_existing_tools_testers_platform_attachment',
                        'any_additional_dev_tools_software_requirements',
                    ];
        }

    private function project_plan_post_data(Request $request) 
        {
            return 
                   [
                        'provide_dev_plan_indicate_major_milestone' => $request->provide_dev_plan_indicate_major_milestone,
                        'manpower_support_requirements' => $request->manpower_support_requirements,
                        'infrastructure_support_requirements' => $request->infrastructure_support_requirements,
                        'details_of_existing_tools_testers_platform' => $request->details_of_existing_tools_testers_platform,
                        'any_additional_dev_tools_software_requirements' => $request->any_additional_dev_tools_software_requirements,
                    ];
        }

    /* CLOSE TAB 5  */



    /* TAB 6 Validation Array */

    private function funding_validation_array()
        {
            return 
                   [
                        'estimated_development_cost',
                        'estimated_development_cost_attachment',
                        'fund_expected',
                        'details_of_funding',
                        'details_of_funding_attachment',
                        'details_self_funding',
                        'details_self_funding_attachment',
                    ];
        }


    private function funding_post_data(Request $request) 
        {
            return 
                   [
                        'estimated_development_cost' => $request->estimated_development_cost,
                        'fund_expected' => $request->fund_expected,
                        'details_of_funding' => $request->details_of_funding,
                        'details_self_funding' => $request->details_self_funding,
                    ];
        }

    /* CLOSE TAB 6  */


    /* TAB 7 Validation Array */

    private function regulatory_validation_array()
        {
            return 
                   [
                        'any_regulatory_approval',
                        'any_other_remarks',
                    ];
        }


    private function regulatory_post_data(Request $request) 
        {
            return 
                   [
                        'any_regulatory_approval' => $request->any_regulatory_approval,
                        'any_other_remarks' => $request->any_other_remarks,
                    ];
        }

    /* CLOSE TAB 7  */

    private function validation_array() 
        {
            return 
                   [
                        'organization_name',
                        'nodal_contact_person',
                        'designation',
                        'authorization_letter',
                        'bio_data_professional_credentials',
                        'contact_no',
                        'email_id',
                        'country',
                        'state',
                        'city',
                        'address',
                        'pin_no',
                        'applying_as',
                        'collaborator_name',
                        'collaborator_designation',
                        'collaborator_contact_no',
                        'collaborator_email_id',
                        'collaborator_industry_cateogory',
                        'collaborator_address',
                        'collaborator_biodata',
                        'collaborator_area_of_work',
                        'collaborator_size_company',
                        'collaborator_location_of_head_office_branch',
                        'collaborator_company_turnover',
                        'collaborator_company_turnover_attachment',
                        'proposed_project_title',
                        'proposed_product_area_category',
                        'technology_area',
                        'stage_of_product_based_on_minimum_technology_readiness_level',
                        'collaboration_customers_clients',
                        'list_of_ipr_awards_paper_published',
                        'relevant_standards_standard_body_membership',
                        'brief_product_solution_idea_description',
                        'brief_product_solution_idea_description_attachment',
                        'primary_objective_of_module_sub_system_product_solution_proposed',
                        'key_deliverables',
                        'type_of_solution_product',
                        'details_prior_experience',
                        'if_the_proposed_solution_product',
                        'is_product_tech_related_to_present_activities',
                        'is_it_new_concept_design_sol_product',
                        'are_there_any_alternate_competive_tech_product',
                        'provide_the_specification_doc_relavant_to_product',
                        'provide_dev_plan_indicate_major_milestone',
                        'provide_dev_plan_indicate_major_milestone_attachment',
                        'manpower_support_requirements',
                        'infrastructure_support_requirements',
                        'infrastructure_support_requirements_attachment',
                        'details_of_existing_tools_testers_platform',
                        'details_of_existing_tools_testers_platform_attachment',
                        'any_additional_dev_tools_software_requirements',
                        'estimated_development_cost',
                        'estimated_development_cost_attachment',
                        'fund_expected',
                        'details_of_funding',
                        'details_of_funding_attachment',
                        'details_self_funding',
                        'details_self_funding_attachment',
                        'any_regulatory_approval',
                        'any_other_remarks'
                    ];
        }



    /* POST Fields */

    private function post_data(Request $request) 
        {
            return 
                   [
                        'organization_name' => $request->organization_name,
                        'nodal_contact_person' => $request->nodal_contact_person,
                        'designation' => $request->designation,
                        'contact_no' => $request->contact_no,
                        'email_id' => $request->email_id,
                        'country' => $request->country,
                        'state' => $request->state,
                        'city' => $request->city,
                        'address' => $request->address,
                        'pin_no' => $request->pin_no,
                        'applying_as' => $request->applying_as,
                        'collaborator_name' => $request->collaborator_name,
                        'collaborator_designation' => $request->collaborator_designation,
                        'collaborator_contact_no' => $request->collaborator_contact_no,
                        'collaborator_email_id' => $request->collaborator_email_id,
                        'collaborator_industry_cateogory' => $request->collaborator_industry_cateogory,
                        'collaborator_address' => $request->collaborator_address,
                        'collaborator_area_of_work' => $request->collaborator_area_of_work,
                        'collaborator_size_company' => $request->collaborator_size_company,
                        'collaborator_location_of_head_office_branch' => $request->collaborator_location_of_head_office_branch,
                        'collaborator_company_turnover' => $request->collaborator_company_turnover,
                        'proposed_project_title' => $request->proposed_project_title,
                        'proposed_product_area_category' => $request->proposed_product_area_category,
                        'technology_area' => $request->technology_area,
                        'stage_of_product_based_on_minimum_technology_readiness_level' => $request->stage_of_product_based_on_minimum_technology_readiness_level,
                        'collaboration_customers_clients' => $request->collaboration_customers_clients,
                        'list_of_ipr_awards_paper_published' => $request->list_of_ipr_awards_paper_published,
                        'relevant_standards_standard_body_membership' => $request->relevant_standards_standard_body_membership,
                        'brief_product_solution_idea_description' => $request->brief_product_solution_idea_description,
                        'primary_objective_of_module_sub_system_product_solution_proposed' => $request->primary_objective_of_module_sub_system_product_solution_proposed,
                        'key_deliverables' => $request->key_deliverables,
                        'type_of_solution_product' => $request->type_of_solution_product,
                        'details_prior_experience' => $request->details_prior_experience,
                        'if_the_proposed_solution_product' => $request->if_the_proposed_solution_product,
                        'is_product_tech_related_to_present_activities' => $request->is_product_tech_related_to_present_activities,
                        'is_it_new_concept_design_sol_product' => $request->is_it_new_concept_design_sol_product,
                        'are_there_any_alternate_competive_tech_product' => $request->are_there_any_alternate_competive_tech_product,
                        'provide_dev_plan_indicate_major_milestone' => $request->provide_dev_plan_indicate_major_milestone,
                        'manpower_support_requirements' => $request->manpower_support_requirements,
                        'infrastructure_support_requirements' => $request->infrastructure_support_requirements,
                        'details_of_existing_tools_testers_platform' => $request->details_of_existing_tools_testers_platform,
                        'any_additional_dev_tools_software_requirements' => $request->any_additional_dev_tools_software_requirements,
                        'estimated_development_cost' => $request->estimated_development_cost,
                        'fund_expected' => $request->fund_expected,
                        'details_of_funding' => $request->details_of_funding,
                        'details_self_funding' => $request->details_self_funding,
                        'any_regulatory_approval' => $request->any_regulatory_approval,
                        'any_other_remarks' => $request->any_other_remarks,
                        'created_at' => $request->created_at,
                    ];
        }

     public function experts_status(Request $request, $enc_id = '')
         {
            try 
              {
                  $id = decrypt($enc_id);
                  $status = AskExpertDetail::select('approved')->where('id', $id)->first()->approved;
                  AskExpertDetail::where('id', $id)->update(['approved' => ! $status]);                    
              } 
            catch (DecryptException $e) {
                  $key = "failure";
                  $msg = 'Something Went Wrong';
            }

            return redirect()->route('expert_user.index')->with($key ?? 'message', $msg ?? 'Changed Successfully');
         }

      public function assigned_application_expert(Request $request) 
        {
            $teams = $request->teams;
            DB::beginTransaction();
            try 
                {
                    $status = 'success';
                    $app_id = Crypt::decryptString(trim($request->app));

                    foreach ($teams as $team_id) {
                        AssignedApplicationToExpert::create(['application_id' => $app_id, 'team_id' => $team_id]);
                    }
                    foreach ($request->evaluation_criteria as $key => $eval_criteria) {
                            ApplicationEvaluationCriteria::create(['application_id' => $app_id, 'criteria' => $eval_criteria, 'max_marks' => $request->max_marks[$key]]);
                    }
                    $msg = "assigned";
                    DB::commit();
                }
            catch (\Exception $e) {
                DB::rollback();
                $status = 'error';
                $msg = $e->getMessage();
            }

            return response()->json(compact('status', 'msg'));
        }

     public function application_evaluation_criteria(Request $request) 
        {

            try {
                    $status = "success";
                    $enc_app_id = $request->app_id;
                    $application_id = Crypt::decrypt($enc_app_id);
                    $records_arr = ApplicationEvaluationCriteria::select(['id', 'criteria', 'max_marks'])->where('application_id', $application_id)->get();
                    $records = [];
                    $app_eval_criteria_marks_obj = [];
                    if (count($records_arr)) {
                        foreach($records_arr as $record) {
                            $records[] = ['id' => Crypt::encrypt($record->id), 'criteria_list' => $record->criteria, 'max_marks' => $record->max_marks, 'i' => $record->id];
                            $app_eval_criteria_id[] = $record->id;
                        }

                        $app_eval_criteria_marks_res = ApplicationEvaluationCriteriaMarks::select(['application_evaluation_criteria_id', 'obtain_marks'])->whereIn('application_evaluation_criteria_id', $app_eval_criteria_id)->where('expert_id', current_user_id())->get()->toArray();
                        foreach($app_eval_criteria_marks_res as $app_eval_criteria_marks) {
                            $app_eval_criteria_marks_obj[$app_eval_criteria_marks['application_evaluation_criteria_id']] = $app_eval_criteria_marks['obtain_marks'];
                        }
                    }

                    $remarks = ApplicationExpertRemark::select('remarks')->where('application_id', $application_id)->where('expert_id', current_user_id())->first()->remarks ?? '';
                } 
            catch (DecryptException $e) {
                $status = "failure";
            }

            return response()->json(compact('status', 'records', 'app_eval_criteria_marks_obj', 'enc_app_id', 'remarks'));
        }

      public function application_evaluation_marks_criteria(Request $request) 
        {
            $max_marks = $request->max_marks;
            DB::beginTransaction();
            try 
                {
                    $status = 'success';
                    foreach($max_marks as $enc_app_eval_criteria_id => $obtain_marks)
                        {
                            $application_evaluation_criteria_id = Crypt::decrypt($enc_app_eval_criteria_id);
                            ApplicationEvaluationCriteriaMarks::create(['application_evaluation_criteria_id' => $application_evaluation_criteria_id, 'expert_id' => current_user_id(), 'obtain_marks' => $obtain_marks]);
                        }
                    $app_id = Crypt::decrypt($request->enc_app_id);
                    ApplicationExpertRemark::insert(['remarks' => $request->remarks, 'application_id' => $app_id, 'expert_id' =>current_user_id()]);
                    $msg = "saved";
                    DB::commit();
                    Session::flash('message', 'Evaluated successfully'); 
                }
            catch (\Exception $e) {
                DB::rollback();
                $status = 'error';
                $msg = $e->getMessage();
                Session::flash('message', 'Something went wrong');
            }
            return response()->json(compact('status', 'msg'));
        }

     public function assigned_experts(Request $request)
         {
            $app_id = $request->appid;
            $users = [];
            try {
                $app_id = Crypt::decryptString($app_id);

                /*$users = AssignedApplicationToExpert::select('users.id', 'users.name', 'users.email')->leftJoin('users', function($join) {
                              $join->on('assigned_6g_application_to_expert.expert_id', '=', 'users.id');
                            })
                            ->where('assigned_6g_application_to_expert.application_id', $app_id)
                            ->get();
                */

                $users = DB::SELECT("SELECT `id`, `name`, `email` FROM `" . DB::getTablePrefix() . "users` WHERE `id` IN (SELECT `expert_id` FROM `" . DB::getTablePrefix() . "evaluation_committee_experts` WHERE `evaluation_committee_id` IN (SELECT `team_id` FROM `" . DB::getTablePrefix() . "assigned_6g_application_to_expert` WHERE `application_id` = $app_id)) ORDER BY `name` ASC");

                /*$evalaution_submit = AssignedApplicationToExpert::select('assigned_6g_application_to_expert.expert_id')->rightJoin('application_evaluation_criteria_marks', function($join) {
                              $join->on('assigned_6g_application_to_expert.expert_id', '=', 'application_evaluation_criteria_marks.expert_id');
                            })
                            ->where('assigned_6g_application_to_expert.application_id', $app_id)
                            ->get()->toArray();
                */

                /*$evalaution_submit = ApplicationEvaluationCriteriaMarks::select('assigned_6g_application_to_expert.expert_id')->rightJoin('application_evaluation_criteria_marks', function($join) {
                              $join->on('assigned_6g_application_to_expert.expert_id', '=', 'application_evaluation_criteria_marks.expert_id');
                            })
                            ->where('assigned_6g_application_to_expert.application_id', $app_id)
                            ->get()->toArray();
*/

		$evalaution_submit = DB::SELECT("SELECT distinct(expert_id) FROM `" . DB::getTablePrefix() . "application_evaluation_criteria_marks` where application_evaluation_criteria_id IN (select id from `" . DB::getTablePrefix() . "application_evaluation_criteria` where application_id = $app_id)"); 

                $evalaution_submit_arr = array_column((array) $evalaution_submit, 'expert_id');

                $status = "success";
                                        
            } catch (DecryptException $e) {
                $status = "failure";
            }

            return response()->json(compact('status', 'users', 'evalaution_submit_arr'));

         }

     public function get_evaluation_reports(Request $request) 
        {
            $res = array();
            try 
                {
                    $app_id = decrypt($request->id);

                    //$expert_users = DB::SELECT("SELECT `id`, `name` FROM `" . DB::getTablePrefix() . "users` WHERE `id` IN (SELECT `expert_id` FROM `" . DB::getTablePrefix() . "assigned_6g_application_to_expert` WHERE `application_id`  = $app_id) ORDER BY `name` ASC");

                    $expert_users = DB::SELECT("SELECT `id`, `name` FROM `" . DB::getTablePrefix() . "users` WHERE `id` IN (SELECT `expert_id` FROM `" . DB::getTablePrefix() . "evaluation_committee_experts` WHERE `evaluation_committee_id` IN (SELECT `team_id` FROM `" . DB::getTablePrefix() . "assigned_6g_application_to_expert` WHERE `application_id` = $app_id)) ORDER BY `name` ASC");

                    $evaluation_criterias = ApplicationEvaluationCriteria::select(['id', 'criteria', 'max_marks'])->where('application_id', $app_id)->get();

                    foreach ($expert_users as $user) 
                        {
                            $evalaution = [];
                            foreach ($evaluation_criterias as $evaluation_criteria) 
                                {
                                    $evaluation_criteria_marks = ApplicationEvaluationCriteriaMarks::where(['application_evaluation_criteria_id' => $evaluation_criteria->id, 'expert_id' => $user->id])->first();
                                    $evalaution[] = ['cid' => $evaluation_criteria->id, 'criteria' => $evaluation_criteria->criteria, 'max_marks' => $evaluation_criteria->max_marks, 'obtain_marks' => $evaluation_criteria_marks->obtain_marks ?? 'N/A'];
                                }

                            $remarks = ApplicationExpertRemark::select('remarks')->where('application_id', $app_id)->where('expert_id', $user->id)->first()->remarks ?? '';

                            $res[] = ['expert' => $user, 'evalaution' => $evalaution, 'remarks' => $remarks];
                        }

                    /* AVG */

                    $avg_query =    DB::SELECT("SELECT
                                                    AVG(b.obtain_marks) AS avg_obtain_marks,
                                                    a.criteria,
                                                    a.max_marks
                                                FROM
                                                    `" . DB::getTablePrefix() . "application_evaluation_criteria` AS a
                                                LEFT JOIN `" . DB::getTablePrefix() . "application_evaluation_criteria_marks` AS b
                                                ON
                                                    b.application_evaluation_criteria_id = a.id
                                                WHERE
                                                    a.application_id = $app_id
                                                GROUP BY
                                                    a.id");

                    $status = 'success';
                    DB::commit();
                }

            catch (\Exception $e) {
                DB::rollback();
                $status = 'success';
            }

           return response()->json(compact('status', 'res'));

            //return view('pages.six_g_user.evaluation_summary', compact('status', 'res', 'avg_query'));
        }

}
