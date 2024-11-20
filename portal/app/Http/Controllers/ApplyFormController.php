<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplyForm;

class ApplyFormController extends Controller
{

    const MSE_CERTIFICATE_PATH = 'public/uploads';
    const SOLUTION_MSE_CERTIFICATE_PATH = 'public/uploads';
    const SIGNATURE_PATH = 'public/images';
    const INCORPORATION_PATH = 'public/uploads';
    const SELF_DECLARATION_PATH = 'public/uploads';
    const SELF_DECLARATION_LAB_PATH = 'public/uploads';
    const DRAFT_PATH = 'public/uploads';
    const OWNERSHIP_PATH = 'public/uploads';


    public function index()
    {

        return view('apply-form');

    }

    public function store(Request $request)
    {
        $request->validate($this->validationArray());
        $post_data = $this->getPostData($request);

       // echo "<pre>"; print_r($post_data); die;
 
         try {

             $data = ApplyForm::create($post_data);
 
         } catch (\Exception $e) { 
             $key = 'error';
             $msg = $e->getMessage();
         }
         return redirect()->route('apply-form.index')->with($key ?? 'message', $msg ?? 'Added Successfully');

    }

    private function getPostData(Request $request) {

        $mse_certificate = time() . "-tcil." . $request->mse_certificate->extension();
        $request->mse_certificate->storeAs(self::MSE_CERTIFICATE_PATH,$mse_certificate);
 
        $solution_mse_certificate = time() . "-tcil." . $request->solution_mse_certificate->extension();
        $request->solution_mse_certificate->storeAs(self::SOLUTION_MSE_CERTIFICATE_PATH,$solution_mse_certificate);
 
        $signature = time() . "-tcil." . $request->signature->extension();
        $request->signature->storeAs(self::SIGNATURE_PATH,$signature);

        $cert_incorporation = time() . "-tcil." . $request->cert_incorporation->extension();
        $request->cert_incorporation->storeAs(self::INCORPORATION_PATH,$cert_incorporation);

        $cert_self_declaration = time() . "-tcil." . $request->cert_self_declaration->extension();
        $request->cert_self_declaration->storeAs(self::SELF_DECLARATION_PATH,$cert_self_declaration);

        $cert_self_declaration_lab = time() . "-tcil." . $request->cert_self_declaration_lab->extension();
        $request->cert_self_declaration_lab->storeAs(self::SELF_DECLARATION_LAB_PATH,$cert_self_declaration_lab);

        $cert_draft = time() . "-tcil." . $request->cert_draft->extension();
        $request->cert_draft->storeAs(self::DRAFT_PATH,$cert_draft);

        $cert_ownership = time() . "-tcil." . $request->cert_ownership->extension();
        $request->cert_ownership->storeAs(self::OWNERSHIP_PATH,$cert_ownership);

        return [
        'company_name' => $request->company_name,
        'cin_number' => $request->cin_number,
        'regd_office_address' => $request->regd_office_address,
        'corp_office_address' => $request->corp_office_address,
        'company_website' => $request->company_website,
        'mse_type' => $request->mse_type,
        'mse_certificate' => $mse_certificate, 
        'name' => $request->name,
        'designation' => $request->designation,
        'contact_no' => $request->contact_no,
        'email_id' => $request->email_id,
        'cheque_no' => $request->cheque_no,
        'amount' => $request->amount,
        'issue_date' => $request->issue_date,
        'issue_branch' => $request->issue_branch,
        'payment_mode' => $request->payment_mode,
        'solution_name' => $request->solution_name,
        'solution_designed_for' => $request->solution_designed_for,
        'solution_compiles_to' => $request->solution_compiles_to,
        'solution_source' => $request->solution_source,
        'solution_telecom' => $request->solution_telecom,
        'solution_testing' => $request->solution_testing,
        'solution_mse_type' => $request->solution_mse_type,
        'solution_mse_certificate' => $solution_mse_certificate, 
        'bsnl_voltage' => $request->bsnl_voltage,
        'bsnl_current' => $request->bsnl_current,
        'bsnl_space' => $request->bsnl_space,
        'bsnl_port' => $request->bsnl_port,
        'bsnl_bandwidth' => $request->bsnl_bandwidth,
        'bsnl_testing_location' => $request->bsnl_testing_location,
        'requirements' => $request->requirements,
        'signature' =>   $signature,
        'cert_incorporation' => $cert_incorporation,
        'cert_self_declaration' =>   $cert_self_declaration,
        'cert_self_declaration_lab' =>   $cert_self_declaration_lab,
        'cert_draft' =>   $cert_draft,
        'cert_ownership' =>   $cert_ownership ?? ''
        ];
    }

    private function validationArray() {
        return [
                    'company_name' => 'required|max:96',
                    'cin_number' => 'required|max:96',
                    'regd_office_address' => 'required|string|min:1|max:500',
                    'corp_office_address' => 'required|string|min:1|max:500',
                    'company_website' => 'required|max:96',
                    'mse_type' => 'required|max:96',
                    'mse_certificate' => 'required|mimes:pdf|max:2048',
                    'name' => 'required|max:96',
                    'designation' => 'required|max:96',
                    'contact_no' => 'required|max:10',
                    'email_id' => 'required|email|unique:apply_forms,email_id',
                    'cheque_no' => 'required|max:96',
                    'amount' => 'required|max:96',
                    'issue_date' => 'required',
                    'issue_branch' => 'required|max:96',
                    'payment_mode' => 'required|max:96',
                    'solution_name' => 'required|string|min:1|max:500',
                    'solution_designed_for' => 'required|string|min:1|max:500',
                    'solution_compiles_to' => 'required|max:96',
                    'solution_source' => 'required|string|min:1|max:500',
                    'solution_telecom' => 'required|string|min:1|max:500',
                    'solution_testing' => 'required|max:96',
                    'solution_mse_type' => 'required|max:96',
                    'solution_mse_certificate' => 'required|mimes:pdf|max:2048',
                    'bsnl_voltage' => 'required|max:96',
                    'bsnl_current' => 'required|max:96',
                    'bsnl_space' => 'required|string|min:1|max:500',
                    'bsnl_port' => 'required|max:96',
                    'bsnl_bandwidth' => 'required|max:96',
                    'bsnl_testing_location' => 'required|max:96',
                    'requirements' => 'required|string|min:1|max:500',
                    'signature' => 'required|mimes:jpg,jpeg,png|max:1024',
                    'cert_incorporation' => 'required|mimes:pdf|max:2048',
                    'cert_self_declaration' => 'required|mimes:pdf|max:2048',
                    'cert_self_declaration_lab' => 'required|mimes:pdf|max:2048',
                    'cert_draft' => 'required|mimes:pdf|max:2048',
                    'cert_ownership' => 'required|mimes:pdf|max:2048',
                ];
    }

    public function display()
    {

        $records = ApplyForm::orderBy('id', 'DESC')->get();

        //echo "<pre>"; print_r($records->toArray()); die;

        return view('apply-form-view',compact('records'));
    }

    public function getdata($id)
    {
        $data  = ApplyForm::find($id);

        //echo "<pre>"; print_r($data->toArray()); die;

        return view('apply-form-view', compact('data'));

    }
	
	public function downloadPDF($id)
    {
        $pdf_uploads = DB::table('apply_forms')->where('id',$id)->first();
        //echo '<pre>';print_r($pdf_uploads->cert_ownership); die;
        $path_to_file = "storage/app/public/uploads/".$pdf_uploads->cert_ownership;
        return \Response::download($path_to_file);
       // return dd('ok');

    }

    
}