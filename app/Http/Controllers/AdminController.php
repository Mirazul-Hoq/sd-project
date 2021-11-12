<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function teacherList()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.pages.teacher_list', compact('teachers'));
    }

    public function teacher()
    {
        return view('admin.pages.teacher');
    }
}
