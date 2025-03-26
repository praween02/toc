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
        
        // Start building the query
        $query = EquipmentList::query();
        
        // Check if user is an institute
        $userIsInstitute = in_array('institute', get_roles()); // Assuming this is how you check roles
        $instituteId = null;
        
        if ($userIsInstitute) {
            // Get the institute ID of the logged-in user
            $instituteId = auth()->user()->institute_id; // Adjust this based on your user-institute relationship
            
            // Automatically filter by the user's institute
            $query->where('institute_id', $instituteId);
        } 
        // If not an institute user but filter is selected
        elseif ($request->has('institute_id') && !empty($request->institute_id)) {
            $instituteId = $request->institute_id;
            $query->where('institute_id', $instituteId);
        }
        
        // Get the filtered results
        $equipmentList = $query->get();
        
        // Pass both the list of institutes and the selected institute ID to the view
        return view('pages.equipment-list.index', compact('equipmentList', 'institutes', 'instituteId', 'userIsInstitute'));
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
