<?php

namespace App\Http\Controllers;

use App\Models\LabRegistration;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LabRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = LabRegistration::query();

        // Filter by status if provided
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $registrations = $query->latest()->paginate(10);

        return view('pages.lab-registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lab-registrations.create');
    }

    /**
     * Show the lab registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        // Get all institutes for the dropdown
        $institutes = Institute::all();
        return view('lab-registration.form', compact('institutes'));
    }

    /**
     * Store a new lab registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'applicant_category' => 'required',
            'subcategory' => 'required',
            'person_name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'institute_id' => 'required',
            'institute_company' => 'required_if:institute_id,other',
            'address' => 'required|string',
            'mobile_no' => 'required|string|max:15',
            'email_id' => 'required|string|email|max:255|unique:lab_registrations',
            'reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create new registration
        $registration = new LabRegistration();
        $registration->applicant_category = $request->applicant_category;
        $registration->subcategory = $request->subcategory;
        $registration->person_name = $request->person_name;
        $registration->qualification = $request->qualification;
        $registration->designation = $request->designation;
        
        // Handle institute selection or custom entry
        if ($request->institute_id == 'other') {
            $registration->institute_company = $request->institute_company;
            $registration->institute_id = null;
        } else {
            $registration->institute_id = $request->institute_id;
            $institute = Institute::find($request->institute_id);
            $registration->institute_company = $institute ? $institute->name : null;
        }
        
        $registration->address = $request->address;
        $registration->mobile_no = $request->mobile_no;
        $registration->email_id = $request->email_id;
        $registration->reason = $request->reason;
        $registration->status = 'pending';
        $registration->save();

        // Redirect to success page with email as query parameter
        return redirect()->route('lab.registration.success', ['email' => $registration->email_id]);
    }

    /**
     * Show success page after registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $email = $request->query('email', 'your email address');
        return view('lab-registration.success', compact('email'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabRegistration  $labRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(LabRegistration $labRegistration)
    {
        return view('lab-registrations.show', compact('labRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LabRegistration  $labRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(LabRegistration $labRegistration)
    {
        return view('lab-registrations.edit', compact('labRegistration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LabRegistration  $labRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LabRegistration $labRegistration)
    {
        $validator = Validator::make($request->all(), [
            'applicant_category' => 'required',
            'subcategory' => 'required',
            'person_name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'institute_company' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile_no' => 'required|string|max:15',
            'email_id' => 'required|string|email|max:255|unique:lab_registrations,email_id,' . $labRegistration->id,
            'reason' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update registration
        $labRegistration->applicant_category = $request->applicant_category;
        $labRegistration->subcategory = $request->subcategory;
        $labRegistration->person_name = $request->person_name;
        $labRegistration->qualification = $request->qualification;
        $labRegistration->designation = $request->designation;
        $labRegistration->institute_company = $request->institute_company;
        $labRegistration->address = $request->address;
        $labRegistration->mobile_no = $request->mobile_no;
        $labRegistration->email_id = $request->email_id;
        if ($request->filled('password')) {
            $labRegistration->password = Hash::make($request->password);
        }
        $labRegistration->reason = $request->reason;
        $labRegistration->status = $request->status;
        $labRegistration->save();

        return redirect()->route('lab-registrations.index')
            ->with('success', 'Lab registration updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LabRegistration  $labRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabRegistration $labRegistration)
    {
        $labRegistration->delete();

        return redirect()->route('lab-registrations.index')
            ->with('success', 'Lab registration deleted successfully.');
    }

    /**
     * Update the status of a registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LabRegistration  $labRegistration
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, LabRegistration $labRegistration)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'reason' => 'nullable|string',
        ]);

        $labRegistration->status = $request->status;
        if ($request->filled('reason')) {
            $labRegistration->reason = $request->reason;
        }
        $labRegistration->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
