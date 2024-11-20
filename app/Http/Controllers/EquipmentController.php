<?php

namespace App\Http\Controllers;

use App\Models\{Equipment,EquipmentSpecification};
use Illuminate\Http\Request;

use App\DataTables\EquipmentsDataTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EquipmentsDataTable $dataTable)
    {
        //
        //abort_if(permission('equipment.list'), 403, __('app.permission_denied'));

        return $dataTable->render('pages.equipment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        abort_if(permission('equipment.create'), 403, __('app.permission_denied'));

        return view('pages.equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        abort_if(permission('equipment.create'), 403, __('app.permission_denied'));

        $request->validate([
                                'equipment' => 'required|max:255',
                          ]);
        try {
            Equipment::create(['equipment' => $request->equipment, 'created_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }
        return redirect()->route('equipments.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        //
        abort_if(permission('equipment.update'), 403, __('app.permission_denied'));

        return view('pages.equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        //
        abort_if(permission('equipment.update'), 403, __('app.permission_denied'));

        $request->validate([
                                'equipment' => 'required|unique:equipments,equipment,' . $equipment->id . '|max:255',
                          ]);
        try {
            $equipment->update(['equipment' => $request->equipment, 'updated_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('equipments.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        //
    }

    /**
     * Update equipment specification.
     */

    public function specification(Request $request, $encrypted_equipment_id = "")
    {
        //
        try {
                $equipment_id = Crypt::decryptString($encrypted_equipment_id);
            } 
        catch (DecryptException $e) {
                abort(404);
        }

        $record = DB::table('equipments')
                        ->select('equipments.equipment', 'equipments.model', 'equipment_specifications.specification', 'equipment_specifications.image')
                        ->leftJoin('equipment_specifications', function ($join) {
                            $join->on('equipment_specifications.equipment_id', '=' , 'equipments.id') ;
                            $join->where('equipment_specifications.vendor_id', '=', current_user_id()) ;
                        })
                        ->where('equipments.id', $equipment_id)
                        ->first();

        return view('pages.equipment.equipment_specification', compact('encrypted_equipment_id', 'record'));
    }


}
