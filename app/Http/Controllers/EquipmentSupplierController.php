<?php

namespace App\Http\Controllers;

use App\Models\EquipmentSupplier;
use Illuminate\Http\Request;
use App\DataTables\EquipmentSuppliersDataTable;

use DB;

class EquipmentSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EquipmentSuppliersDataTable $dataTable)
    {
        abort_if(permission('equ_suppliers.list'), 403, __('app.permission_denied'));
        return $dataTable->render('pages.equipment_suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(permission('equ_suppliers.create'), 403, __('app.permission_denied'));
        return view('pages.equipment_suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(permission('equ_suppliers.create'), 403, __('app.permission_denied'));

        $request->validate($this->validationArray());
        $post_data = $request->except('_method', '_token');
        $post_data['created_at'] = date("Y-m-d H:i:s");

        try {
            EquipmentSupplier::create($post_data);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('equipment_suppliers.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentSupplier $equipmentSupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipmentSupplier $equipmentSupplier)
    {
        abort_if(permission('equ_suppliers.update'), 403, __('app.permission_denied'));
        return view('pages.equipment_suppliers.edit', compact('equipmentSupplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EquipmentSupplier $equipmentSupplier)
    {
        abort_if(permission('equ_suppliers.update'), 403, __('app.permission_denied'));

        $request->validate($this->validationArray());

        $post_data = $request->except('_method', '_token');
        $post_data['updated_at'] = date("Y-m-d H:i:s");

        try {
             $equipmentSupplier->update($post_data);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('equipment_suppliers.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentSupplier $equipmentSupplier)
    {
        //
        abort_if(permission('equ_suppliers.delete'), 403, __('app.permission_denied'));
    }


    /**
     *  return array after check validation
     */

    private function validationArray()
    {
        return [
                    'company_name' => 'required|max:96',
                    'address' => 'required',
                    'email' => 'required|email|max:96',
                    'contact_person' => 'required|max:96',
                    'contact_number' => 'required|max:32',
                ];
    }

}
