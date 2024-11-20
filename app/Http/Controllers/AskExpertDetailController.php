<?php

namespace App\Http\Controllers;

use App\Models\AskExpertDetail;
use Illuminate\Http\Request;

use App\DataTables\AskExpertDetailsDataTable;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use DB;

class AskExpertDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AskExpertDetailsDataTable $dataTable)
    {
        //
        return $dataTable->render('pages.ask_expert.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.ask_expert.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //abort_if(permission('course.create'), 403, __('app.permission_denied'));

        $request->validate([
                                'family_name' => 'required|max:96',
                                'first_name' => 'required|max:96',
                                'gender' => 'required|max:1',
                                'position' => 'required|max:96',
                                'current_organization' => 'required|max:128',
                                'affiliations_certifications' => 'required|max:128',
                                'nationality' => 'required|max:2',
                                'graduation_date' => 'required',
                                'official_email' => 'required|email|max:96',
                                'personal_email' => 'required|email|max:96',
                                'address' => 'required|max:255',
                                'city' => 'required|max:96',
                                'post_code' => 'required|max:12',
                                'country' => 'required|max:96',
                                'whether_have_oci' => 'required',
                                'tel_prof' => 'required|max:96',
                                'tel_mobile' => 'required|max:96',
                                'tel_private' => 'required|max:96',
                                'activity' => 'required|max:96',
                                'cv' => 'required|mimes:pdf',
                                'id_number' => 'required|max:32',
                                'id_proof_document' => 'required|mimes:pdf',
                                'photograph' => 'required|mimes:jpeg,jpg,png,gif',
                                'web_page' => 'required|url|max:255',
                          ]);

        $post_data      =           [
                                        'family_name' => $request->family_name, 
                                        'first_name' => $request->first_name, 
                                        'gender' => $request->gender, 
                                        'position' => $request->position, 
                                        'current_organization' => $request->current_organization, 
                                        'affiliations_certifications' => $request->affiliations_certifications, 
                                        'nationality' => $request->nationality, 
                                        'graduation_date' => $request->graduation_date, 
                                        'official_email' => $request->official_email, 
                                        'personal_email' => $request->personal_email, 
                                        'address' => $request->address, 
                                        'city' => $request->city, 
                                        'post_code' => $request->post_code, 
                                        'country' => $request->country, 
                                        'whether_have_oci' => $request->whether_have_oci, 
                                        'tel_prof' => $request->tel_prof, 
                                        'tel_mobile' => $request->tel_mobile, 
                                        'tel_private' => $request->tel_private, 
                                        'fax_prof' => $request->fax_prof, 
                                        'activity' => $request->activity, 
                                        'id_number' => $request->id_number,  
                                        'web_page' => $request->web_page, 
                                        'created_at' => date("Y-m-d H:i:s")
                                    ];

        $uploads_fields = ['cv', 'id_proof_document', 'photograph'];

        foreach ($uploads_fields as $key => $file_name)
            {   
                if ($request->hasFile($file_name)) {
                    $file = $request->file($file_name);
                    $client_original_file_name = '5GLab_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/files', $client_original_file_name);
                    $post_data[$file_name] = $client_original_file_name;
                }
            }

        try {

            AskExpertDetail::create($post_data);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }

        return redirect()->route('ask_expert.index')->with($key ?? 'message', $msg ?? 'Submitted Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(AskExpertDetail $askExpertDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AskExpertDetail $askExpertDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AskExpertDetail $askExpertDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AskExpertDetail $askExpertDetail)
    {
        //
    }
}
