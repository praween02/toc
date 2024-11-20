<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{AskExpertDetail,User,EvaluationCommitteeExpert};
use App\DataTables\AskExpertDetailsDataTable;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use DB;
use Validator;
use Session;
use Log;


class ExpertUserControllerr extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(AskExpertDetailsDataTable $dataTable)
        {
            //
	    abort_if((count(array_intersect(['admin_view','user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
	    $total_applications = AskExpertDetail::count();
            return $dataTable->render('pages.ask_expert.index', compact('total_applications'));
        }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
        {
            $countries =  DB::table('countries')->select(['id', 'name'])->orderBy('name', 'ASC')->get();
            $expertises =  DB::table('area_expertises')->select(['id', 'expertise'])->where('status', 1)->orderBy('id', 'ASC')->get();
            return view('pages.ask_expert.create', compact('countries', 'expertises'));
        }


    private function post_data(Request $request) 
       {
            $fields_arr = ['family_name', 'first_name', 'position', 'current_organization', 'affiliations_certifications', 'nationality', 'graduation_date', 'official_email', 'personal_email', 'address', 'city', 'state', 'post_code', 'country', 'whether_have_oci', 'telephone', 'tel_mobile', 'fax_prof', 'activity', 'other', 'remarks', 'level', 'id_number', 'web_page'];

            foreach ($fields_arr as $field)
            $post_fields[$field] = $request->{$field};

            return $post_fields;
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request): JsonResponse
        {
            abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            $request->validate($this->validation_array());

            $post_data = $this->post_data($request);

            $post_data['user_id'] = current_user_id();

            $uploads_fields = ['cv', 'id_proof_document', 'photograph'];

            foreach ($uploads_fields as $key => $file_name)
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
                    $status = 'success';
                    $msg = "saved";
                    AskExpertDetail::create($post_data);
                    Session::flash('message', 'Submitted successfully'); 
                } 
            catch (\Exception $e) {
                    $status = 'error';
                    $msg = $e->getMessage();
                    Log::info("EXPERT USER ISSUE - " . $msg);
            }

            return response()->json(compact('status', 'msg'));
        }

    /**
     * Display the specified resource.
     */

    public function show(Request $request)
        {
            $path = url('storage/uploads');
            try {
                    $status = "success";
                    $application_id = Crypt::decrypt($request->react_id);
                    $response = AskExpertDetail::whereId($application_id)->first();
                    $response->{'city'} = $response->city_data->name ?? 'N/A';
                    $response->{'state'} = $response->state_data->name ?? 'N/A';
                    $response->{'country'} = $response->country_data->name ?? 'N/A';
		    $response->{'activity'} = $response->activity_data->expertise ?? 'N/A';
                    unset($response->id);
                    unset($response->user_id);
            } 
            catch (DecryptException $e) {
                $status = "failure";
                $response = "something went wrong. try again!";
                $path = "";
            }   

            return response()->json(compact('response', 'status', 'path'));
        }

    /**
     * Validation array.
     */

    private function validation_array($payment_mode = '') 
        {
            return [
                        'family_name' => 'required|min:2|max:96',
                        'first_name' => 'required|min:2|max:96',
                        'position' => 'required|min:2|max:96',
                        'current_organization' => 'required|min:2|max:2048',
                        'affiliations_certifications' => 'required|min:8|max:2048',
                        'graduation_date' => 'required|date',
                        'official_email' => 'required|email|max:96',
                        'personal_email' => 'required|email|max:96',

                        'address' => 'required|min:12|max:1024',
                        'city' => 'required|integer',
                        'state' => 'required|integer',
                        'country' => 'required|integer',
                        'post_code' => 'required|integer',

                        'whether_have_oci' => 'required|max:16',
                        'telephone' => 'required|min:10|max:12',
                        'tel_mobile' => 'required|min:10|max:12',

                        //'fax_prof' => 'min:10|max:12',

                        'level' => 'required|max:16',
                        'cv' => 'required|mimes:pdf',
                        'id_number' => 'required|min:3|max:16',
                        'id_proof_document' => 'required|mimes:pdf',
                        'photograph' => 'required|mimes:jpeg,png,jpg',
                        'web_page' => 'required|url|max:255',
                    ];
        }

    public function expert_user_assigned()
        {
            //abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

            $evaluation_committee_ids =  EvaluationCommitteeExpert::select('evaluation_committee_id')->distinct()->where('expert_id', current_user_id())->get()->toArray();
            $team_ids = array_column($evaluation_committee_ids, 'evaluation_committee_id');

            $assigned_application = DB::table('6g_applications')
                                        ->select('users.name', '6g_applications.id', '6g_applications.organization_name', '6g_applications.nodal_contact_person', '6g_applications.designation', '6g_applications.contact_no', '6g_applications.email_id')
                                        ->leftJoin('assigned_6g_application_to_expert', function ($join) {
                                            $join->on('6g_applications.id', '=' , 'assigned_6g_application_to_expert.application_id');
                                        })
                                        ->leftJoin('users', function ($join) {
                                            $join->on('6g_applications.user_id', '=' , 'users.id');
                                        })
                                        ->whereIn('assigned_6g_application_to_expert.team_id', $team_ids)
                                        ->orderBy('6g_applications.id', 'DESC')
                                        ->paginate(1);

            return view('pages.ask_expert.assigned_application', compact('assigned_application'));
        }


   public function nda() {
        $nda = AskExpertDetail::select('nda_agreement')->where('user_id', current_user_id())->first()->nda_agreement;
        return view('pages.ask_expert.nda', compact('nda'));
    }

    public function nda_submit(Request $request) {

        $request->validate(['nda' => 'required|mimes:docx']);

        try
          {
                if ($request->hasFile('nda')) {
                    $file = $request->file('nda');
                    $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/uploads', $client_original_file_name);
                    date_default_timezone_set('Asia/Kolkata');
                    AskExpertDetail::where('user_id', current_user_id())->update(['nda_agreement' => $client_original_file_name, 'nda_upload_date_time' => date("Y-m-d H:i:s")]);
                }
          }

        catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }
        return redirect()->route('expert.nda')->with($key ?? 'message', $msg ?? 'Uploaded Successfully');
    }


    public function nda_admin()
      {
           $nda_listing = AskExpertDetail::select('first_name', 'nda_agreement', 'nda_upload_date_time')->whereNotNull('nda_agreement')->orderBy('nda_upload_date_time', 'DESC')->get();
           return view('pages.ask_expert.nda_listing', compact('nda_listing'));
      }


}
