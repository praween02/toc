<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Institute, User, VendorInstitute, Zone, VendorZone};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorInstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assigned_institutes = VendorInstitute::select('institute_id')->pluck('institute_id')->toArray();
        $vendors = User::
                        select(['users.id', 'users.name'])
                        ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
                        ->leftJoin('roles', 'role_users.role_id', '=', 'roles.id')
                        ->where('roles.name', 'vendor')
                        ->orderBy('users.name', 'ASC')
                        ->get();

        $institutes = Institute::select(['id', 'institute'])->orderBy('institute', 'ASC')->get();
        $zones = Zone::select(['id', 'zone'])->orderBy('zone', 'ASC')->get();
        return view('pages.vendor_institutes.create', compact('institutes', 'vendors', 'assigned_institutes', 'zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                                'zone' => 'required',
                                'vendor' => 'required',
                                'institute_id' => 'required|array',
                                'institute_id.*' => 'required',
                          ]);

        DB::beginTransaction();

        $vendor_id = $request->vendor;

        try {
                $check_zone_assigned_to_vendor = VendorZone::where(['vendor_id' => $vendor_id, 'zone_id' => $request->zone])->first();
                if ($check_zone_assigned_to_vendor === null) {
                    $vendor_zone_id = VendorZone::create(['vendor_id' => $vendor_id, 'zone_id' => $request->zone, 'created_at' => date('Y-m-d H:i:s')])->id;
                } else {
                    $vendor_zone_id = $check_zone_assigned_to_vendor->id;
                }

                foreach ($request->institute_id as $inst_id) {
                    VendorInstitute::create(['vendor_zone_id' => $vendor_zone_id, 'institute_id' => $inst_id, 'random_id' => Str::random(32), 'created_at' => date('Y-m-d H:i:s')]);
                }

                DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('vendors.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorInstitute $vendorInstitute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorInstitute $vendorInstitute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorInstitute $vendorInstitute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorInstitute $vendorInstitute)
    {
        //
    }

    /**
     * Get the vendor institutes
     */



    public function vendorInstitutes(Request $request) {

        $vendor_id = $request->id;
        $institutes = VendorInstitute::
                        select(['institutes.id', 'institutes.institute', 'vendor_zone_institutes.created_at', 'zones.zone', 'vendor_zone_institutes.id', 'vendor_zone_institutes.random_id'])
                        ->leftJoin('institutes', 'vendor_zone_institutes.institute_id', '=', 'institutes.id')
                        ->leftJoin('vendor_zones', 'vendor_zone_institutes.vendor_zone_id', '=', 'vendor_zones.id')
                        ->leftJoin('zones', 'vendor_zones.zone_id', '=', 'zones.id')
                        ->where('vendor_zones.vendor_id', $vendor_id)
                        ->orderBy('institutes.institute', 'ASC')
                        ->get();
        return response()->json(compact('institutes'));
    }

}
