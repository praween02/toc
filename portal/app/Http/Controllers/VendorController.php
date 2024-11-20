<?php

namespace App\Http\Controllers;

use App\Models\{Vendor,User};
use Illuminate\Http\Request;

use App\DataTables\VendorsDataTable;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorsDataTable $dataTable)
    {
        //
        return $dataTable->render('pages.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
                                'name' => 'required|max:255',
                                'email' => 'required|unique:users|max:255',
                                'password' => 'required|min:8',
                                'address1' => 'required',
                          ]);
        try {
            $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => $request->password, 'created_at' => date("Y-m-d H:i:s")]);

            $user->profile()->create(['vendor_id' => $user->id, 'address1' => $request->address1, 'address2' => $request->address2,'mobile' => $request->mobile]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }

        return redirect()->route('vendors.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
        //$vendor_info = User::whereId($vendor->vendor_id)->

        return view('pages.vendor.edit', compact('vendor_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
        $request->validate([
                                'name' => 'required|max:255',
                                'email' => 'required|unique:users,email,' . $vendor->vendor_id . '|max:255',
                          ]);
        try {
            $user = User::where('id', $vendor->vendor_id)->update(['name' => $request->name, 'email' => $request->email, 'updated_at' => date("Y-m-d H:i:s")]);
            $user->profile()->update(['address1' => $request->address1, 'address2' => $request->address2, 'mobile' => $request->mobile]);

            //Vendor::where('vendor_id', $vendor->vendor_id)->update(['zone_id' => $request->zone_id]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('vendors.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
