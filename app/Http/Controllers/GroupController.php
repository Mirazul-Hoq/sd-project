<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Group;
use Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::where('user_id', Auth::id())->get();
        $courses = Course::all();
        return view('admin.pages.group', compact('courses', 'groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'course_id' => 'required|integer',
            'member_no' => 'required|integer|max:3|min:1',
        ]);

        $checkName = Group::where('name', $request->name)
                          ->where('course_id', $request->course_id)
                          ->first();
        $checkUser = Group::where('user_id', Auth::id())
                          ->where('course_id', $request->course_id)
                          ->first();
        if ($checkName || $checkUser) {
            return redirect()->back()->with('msg', 'Group is already created');
        } else {
            $group = new Group();
            $group->name = $request->name;
            $group->user_id = Auth::id();
            $group->course_id = $request->course_id;
            $group->member_no = $request->member_no;
            $group->status = 1;

            $group->save();
            if ($group) {
                return redirect()->back();
            } else {
                abort('404');
            }
        }
    }

    public function update(Request $request, $group)
    {
        $request->validate([
            'member_no' => 'required|integer|max:3|min:1',
        ]);

        $update = Group::findOrFail($group);
        $update->member_no = $request->member_no;

        $update->update();
        if ($update) {
            return redirect()->back();
        } else {
            abort('404');
        }
        
    }
}
