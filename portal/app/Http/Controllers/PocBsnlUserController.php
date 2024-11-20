<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PocBsnlsDataTable;
use App\Models\PocBsnl;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use DB;

class PocBsnlUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PocBsnlsDataTable $dataTable)
    {
        //
        //return $dataTable->render('pages.poc_bsnl.index');
        $arrContextOptions  = array(
                                        "ssl" => array(
                                            "verify_peer"=>false,
                                            "verify_peer_name"=>false,
                                        ),
                                  ); 
        $userId = Auth::user()->id;
        $users_res = DB::table('poc_bsnls')->where('user_id',$userId)->get();
        //$users_res = json_decode(file_get_contents('https://bharat5glabs.gov.in/api/pocUsersId/'.$userId, false, stream_context_create($arrContextOptions)));
        $users = $users_res;
        //$users = $users_res->data;
        //$path = $users_res->url;
        $path = 'https://www.bharat5glabs.gov.in/uploads/doc/';

        
        return view('pages.poc_bsnl_user.index', compact('users', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.poc_bsnl_user.create');
    }

    
    private function arrContextOptions() {
        return  array(
            "ssl" => array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        /*$enc_application_id = $request->react_id;
        try 
            {
                $application_id = Crypt::decrypt($enc_application_id);
                $response = PocBsnl::whereId($application_id)->first();
                $status = "success";
            }
        catch (\Exception $e) 
            {
                $status = "failure";
                $response = "something went wrong. try again!";
            }
        */
        
        try {
                // $users_res = json_decode(file_get_contents('https://bharat5glabs.gov.in/api/pocUsers/' . $request->react_id, false, stream_context_create($this->arrContextOptions())));
                $users_res = DB::table('poc_bsnls')->where('id',$request->react_id)->first();
        
                // $response = $users_res->data[0];
                // $path = $users_res->url;
                $response = $users_res;
                $path = 'https://www.bharat5glabs.gov.in/uploads/doc/';
                $status = "success";
        }
        catch (\Exception $e) 
            {
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

}
