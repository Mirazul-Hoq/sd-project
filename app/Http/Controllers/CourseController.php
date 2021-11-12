<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.pages.courses', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:courses,name',
            'course_code' => 'required|string|max:100|unique:courses,course_code',
            'status' => 'required|integer|max:1|min:0',
        ]);
        $course = new Course();
        $course->name = $request->name;
        $course->course_code = $request->course_code;
        $course->status = $request->status;

        $course->save();
        if ($course) {
            return redirect()->back();
        } else {
            abort('404');
        }
    }

    public function update(Request $request, $course)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'course_code' => 'required|string|max:100',
            'status' => 'required|integer|max:1|min:0',
        ]);

        $update = Course::findOrFail($course);

        $update->name = $request->name;
        $update->course_code = $request->course_code;
        $update->status = $request->status;

        $update->update();

        if ($update) {
            return redirect()->back();
        } else abort('404');
    }

    public function delete($course)
    {
        $delete = Course::findOrFail($course);
        $delete->delete();
        if ($delete) {
            return redirect()->back();
        } else abort('404');
    }
}
