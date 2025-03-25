<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentList;
use App\Models\Institute;

class EquipmentListController extends Controller
{
    /**
     * Display a listing of the equipment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all institutes for the dropdown
        $institutes = Institute::all();
        
        // Query builder for equipment list
        $query = EquipmentList::query();
        
        // Apply institute filter if selected
        if ($request->has('institute_id') && !empty($request->institute_id)) {
            $query->where('institute_id', $request->institute_id);
        }
        
        // Get the filtered results
        $equipmentList = $query->get();
        
        return view('pages.equipment-list.index', ["institutes" => $institutes, "equipmentList" => $equipmentList]);
    }

    /**
     * Show the form for creating a new equipment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutes = Institute::all();
        return view('pages.equipment-list.create', compact('institutes'));
    }

    /**
     * Store a newly created equipment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'equipment_name' => 'required',
            'model_no' => 'required',
            'date' => 'required|date',
            'running_time' => 'required',
        ]);

        EquipmentList::create($request->all());

        return redirect()->route('equipment-list.index')
            ->with('success', 'Equipment added successfully.');
    }

    /**
     * Display the specified equipment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipmentList = EquipmentList::findOrFail($id);
        return view('pages.equipment-list.show', compact('equipmentList'));
    }

    /**
     * Show the form for editing the specified equipment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipmentList = EquipmentList::findOrFail($id);
        return view('pages.equipment-list.edit', compact('equipmentList'));
    }

    /**
     * Update the specified equipment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'equipment_name' => 'required',
            'model_no' => 'required',
            'date' => 'required|date',
            'running_time' => 'required',
        ]);

        $equipmentList = EquipmentList::findOrFail($id);
        $equipmentList->update($request->all());

        return redirect()->route('equipment-list.index')
            ->with('success', 'Equipment updated successfully');
    }

    /**
     * Remove the specified equipment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipmentList = EquipmentList::findOrFail($id);
        $equipmentList->delete();

        return redirect()->route('equipment-list.index')
            ->with('success', 'Equipment deleted successfully');
    }
}
