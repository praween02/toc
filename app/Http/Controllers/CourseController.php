<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\DataTables\CourseDataTable;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseDataTable $dataTable)
    {
        //
        //abort_if(permission('course.list'), 403, __('app.permission_denied'));
        return $dataTable->render('pages.course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        abort_if(permission('course.create'), 403, __('app.permission_denied'));
        return view('pages.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        abort_if(permission('course.create'), 403, __('app.permission_denied'));

        $request->validate([
                                'course' => 'required|max:255',
                                'status' => 'required',
                          ]);
        try {
            Course::create(['course' => $request->course, 'status' => $request->status, 'created_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
        }
        return redirect()->route('courses.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
        abort_if(permission('course.update'), 403, __('app.permission_denied'));

        return view('pages.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
        abort_if(permission('course.update'), 403, __('app.permission_denied'));

        $request->validate([
                                'course' => 'required|unique:courses,course,' . $course->id . '|max:255',
                                'status' => 'required',
                          ]);
        try {
            $course->update(['course' => $request->course, 'status' => $request->status, 'updated_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('courses.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
