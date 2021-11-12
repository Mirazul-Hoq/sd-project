<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeacherRegId;
use Hash;

class TeacherController extends Controller
{
    public function register()
    {
        return view('admin.pages.teacher_reg');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'teacher_id' => ['required', 'exists:teacher_reg_ids,teacher_reg_id'],
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->teacher_id = $request->teacher_id;
        $user->role = 'teacher';
        $user->password = Hash::make($request->password);
        $user->save();
        if ($user) {
            return view('auth.login');
        } else abort('404');
    }
}
