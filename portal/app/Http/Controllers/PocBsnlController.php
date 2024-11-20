<?php

namespace App\Http\Controllers;

use App\Models\PocBsnl;
use Illuminate\Http\Request;
use App\DataTables\PocBsnlsDataTable;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Illuminate\Http\JsonResponse;
use Session;
use DB;
use Log;

class PocBsnlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PocBsnlsDataTable $dataTable)
    {
        //
        abort_if((count(array_intersect(['admin_view','user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

	$total_applications = PocBsnl::count();
        return $dataTable->render('pages.poc_bsnl.index', compact('total_applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $cities = DB::SELECT("SELECT `id`, `name` FROM `" . DB::getTablePrefix() . "cities` WHERE `state_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "states` WHERE `country_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "countries` WHERE `id` = 102)) ORDER BY `name` ASC");

        return view('pages.poc_bsnl.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        abort_if((count(array_intersect(['user', 'bsnl-user', 'six-g-user', 'expert-user', 'super_admin', 'institute', 'vendor'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $request->validate($this->validation_array($request->payment_mode));

        $post_data = $this->post_data($request);

        $post_data['user_id'] = current_user_id();

        $uploads_fields = ['transaction_receipt', 'mse_certificate', 'signature', 'cert_incorporation', 'cert_self_declaration', 'cert_self_declaration_lab', 'cert_draft', 'cert_ownership'];

        foreach ($uploads_fields as $key => $file_name)
            {   
                if ($key == 'transaction_receipt'):
                    if ($request->payment_mode == 'dd')
                    continue;
                endif;

                if ($request->hasFile($file_name)) {
                    $file = $request->file($file_name);
                    $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/poc_bsnl', $client_original_file_name);
                    $post_data[$file_name] = $client_original_file_name;
                }
            }

        try 
            {
                $status = 'success';
                $msg = "saved";
                PocBsnl::create($post_data);
                Session::flash('message', 'Submitted successfully'); 
            } 
        catch (\Exception $e) {
                $status = 'error';
                $msg = $e->getMessage();
		Log::info("BSNL USER ISSUE - " . $msg);
        }

        return response()->json(compact('status', 'msg'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $path = url('storage/poc_bsnl');
        try {
                $status = "success";
                $application_id = Crypt::decrypt($request->react_id);
                $response = PocBsnl::whereId($application_id)->first();
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
     * Show the form for editing the specified resource.
     */
    public function edit(PocBsnl $pocBsnl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PocBsnl $pocBsnl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PocBsnl $pocBsnl)
    {
        //
    }

    private function post_data(Request $request) 
       {
            $fields_arr = ['company_name', 'cin_number', 'regd_office_address', 'corp_office_address', 'company_website', 'mse_type', 'name', 'designation', 'contact_no', 'email_id', 'cheque_no', 'amount', 'issue_date', 'issue_branch', 'payment_mode', 'solution_name', 'solution_designed_for', 'solution_compiles_to', 'solution_source', 'solution_telecom', 'solution_testing', 'bsnl_voltage', 'bsnl_current', 'bsnl_space', 'bsnl_port', 'bsnl_bandwidth', 'bsnl_testing_location', 'requirements'];

            foreach ($fields_arr as $field)
            $post_fields[$field] = $request->{$field};

            $post_fields['cheque_no'] = '';
            $post_fields['amount'] = '';
            $post_fields['issue_date'] = '';
            $post_fields['issue_branch'] = '';

            if ($request->payment_mode == 'dd') {
                $post_fields['cheque_no'] = $request->cheque_no;
                $post_fields['amount'] = $request->amount;
                $post_fields['issue_date'] = $request->issue_date;
                $post_fields['issue_branch'] = $request->issue_branch;
            }

            return $post_fields;
    }

    private function validation_array($payment_mode = '') 
        {
            $arr = [
                        'company_name' => 'required|min:6|max:1196',
                        'cin_number' => 'max:32',
                        'regd_office_address' => 'required|min:8|max:2048',
                        'corp_office_address' => 'required|min:8|max:2048',
                        'company_website' => 'required|url|max:96',
                        'mse_type' => 'required|max:96',
                        'mse_certificate' => 'required|mimes:pdf,doc,docx',

                        'name' => 'required|max:96',
                        'designation' => 'required|max:96',
                        'contact_no' => 'required|max:12',
                        'email_id' => 'required|email|max:96',

                        //'amount' => 'required|max:16',
                        //'issue_date' => 'required',
                        //'issue_branch' => 'required|max:96',
                        //'payment_mode' => 'required|max:96',

                        'solution_name' => 'required|max:500',
                        'solution_designed_for' => 'required|max:500',
                        'solution_compiles_to' => 'required|max:500',
                        'solution_source' => 'required|max:500',
                        'solution_telecom' => 'required|max:500',
                        'solution_testing' => 'required|max:500',

                        'bsnl_voltage' => 'required|max:32',
                        'bsnl_current' => 'required|max:32',
                        'bsnl_space' => 'required|max:500',
                        'bsnl_port' => 'required|max:32',
                        'bsnl_bandwidth' => 'required|max:32',
                        'bsnl_testing_location' => 'required|max:96',
                        'requirements' => 'min:16',


                        'signature' => 'required|mimes:jpg,jpeg,png',
                        'cert_incorporation' => 'required|mimes:pdf,doc,docx',
                        'cert_self_declaration' => 'required|mimes:pdf,doc,docx',
                        'cert_self_declaration_lab' => 'required|mimes:pdf,doc,docx',
                        'cert_draft' => 'required|mimes:pdf,doc,docx',
                        'cert_ownership' => 'required|mimes:pdf,doc,docx',
                    ];

            if ($payment_mode == 'dd')
            $arr['cheque_no'] = 'required|max:32';

            if ($payment_mode == 'online')
            $arr['transaction_receipt'] = 'required|mimes:pdf,doc,docx';

            return $arr;
        }

}
