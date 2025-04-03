<?php

namespace App\Http\Controllers;

use App\Models\LabGrading;
use App\Models\Institute;
use App\DataTables\LabGradingDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabGradingController extends Controller
{
    public function index(LabGradingDatatable $dataTable)
    {
        return $dataTable->render('pages.lab-grading.index');
    }

    public function create()
    {
        $institutes = Institute::all();
        return view('pages.lab-grading.create', compact('institutes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institute_id' => 'required|exists:institutes,id',
            'innovation_project_check' => 'boolean',
            'beyond_contribution' => 'boolean',
            'use_case_definition' => 'nullable|string',
            'poc_readiness_check' => 'boolean',
            'commercial_product_validation' => 'boolean',
            'ip_identification' => 'nullable|string',
        ]);

        LabGrading::create($validated);

        return redirect()->route('lab.grading.index')
            ->with('success', 'Lab grading created successfully.');
    }

    public function show(LabGrading $labGrading)
    {
        return view('pages.lab-grading.show', compact('labGrading'));
    }

    public function edit(LabGrading $labGrading)
    {
        $institutes = Institute::all();
        return view('pages.lab-grading.edit', compact('labGrading', 'institutes'));
    }

    public function update(Request $request, LabGrading $labGrading)
    {
        $validated = $request->validate([
            'institute_id' => 'required|exists:institutes,id',
            'innovation_project_check' => 'boolean',
            'beyond_contribution' => 'boolean',
            'use_case_definition' => 'nullable|string',
            'poc_readiness_check' => 'boolean',
            'commercial_product_validation' => 'boolean',
            'ip_identification' => 'nullable|string',
        ]);

        $labGrading->update($validated);

        return redirect()->route('lab.grading.index')
            ->with('success', 'Lab grading updated successfully.');
    }

    public function destroy(LabGrading $labGrading)
    {
        $labGrading->delete();

        return redirect()->route('lab.grading.index')
            ->with('success', 'Lab grading deleted successfully.');
    }
} 