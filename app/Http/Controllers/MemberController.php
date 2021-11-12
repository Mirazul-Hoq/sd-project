<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Member;
use Auth;

class MemberController extends Controller
{
    public function index($group)
    {
        $g = Group::findOrFail($group);
        $user = User::findOrFail(Auth::id());
        $id = $g->id;
        $m = Member::where('group_id', $id)->get();
        // dd($m);
        return view('admin.pages.member', compact('g', 'user', 'm'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'exists:users,name'],
            'email' => ['required', 'exists:users,email'],
            'student_id' => ['required', 'exists:users,student_id'],
            'group_id' => ['required']
        ]);
        for ($i = 0; $i < $request->member_no; $i++) {
            $member = new Member();
            $member->name = $request->name[$i];
            $member->email = $request->email[$i];
            $member->student_id = $request->student_id[$i];
            $member->group_id = $request->group_id;
            $member->save();
        }

        return redirect()->back();
    }
}
