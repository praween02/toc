<?php

namespace App\Http\Controllers;

use App\Models\Workshop;

use Illuminate\Http\Request;

use DB;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function workshop()
        {
            return view('workshop');
        }

    public function workshopJoin(Request $request)
        {
            $request->validate([
                                    'person_name' => 'required|max:96',
                                    'organisation_name' => 'required|max:255',
                                    'email_id' => 'required|email|max:96',
                                    'contact_no' => 'required|digits_between:9,12',
                                    'expertise_in' => 'required|max:255',
                                    'purpose_to_attend_workshop' => 'required'
                            ]);
            try {
                Workshop::create(['person_name' => $request->person_name, 'organisation_name' => $request->organisation_name, 'email_id' => $request->email_id, 'contact_no' => $request->contact_no, 'expertise_in' => $request->expertise_in, 'purpose_to_attend_workshop' => $request->purpose_to_attend_workshop, 'created_at' => date("Y-m-d H:i:s")]);
                $key = 'success';
            } catch (\Exception $e) {
                $key = 'error';
                $msg = 'Something Went Wrong';
            }

            if('error' == $key)
            return redirect()->route('workshop')->withInput($request->input());
                else
            return redirect()->route('workshop')->with($key, 'Application submitted successfully');

        }

}
