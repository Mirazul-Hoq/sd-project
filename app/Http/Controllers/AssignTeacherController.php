<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Session;
use App\Models\User;
use App\Models\AssignCourse;

class AssignTeacherController extends Controller
{
    public function index()
    {
        $assigncourses = AssignCourse::all();
        $courses = Course::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.pages.assignteacher', compact('courses', 'sessions', 'teachers', 'assigncourses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer',
            'user_id' => 'required|integer',
            'session_id' => 'required|integer',
            'status' => 'required|integer|max:1|min:0',
        ]);
        $assign = new AssignCourse();
        $assign->course_id = $request->course_id;
        $assign->user_id = $request->user_id;
        $assign->session_id = $request->session_id;
        $assign->status = $request->status;

        $assign->save();
        if ($assign) {
            return redirect()->back();
        } else {
            abort('404');
        }
    }
}
