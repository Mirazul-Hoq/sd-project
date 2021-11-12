<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::all();
        return view('admin.pages.sessions', compact('sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:sessions,name',
            'status' => 'required|integer|max:1|min:0',
        ]);
        $session = new Session();
        $session->name = $request->name;
        $session->status = $request->status;

        $session->save();
        if ($session) {
            return redirect()->back();
        } else {
            abort('404');
        }
    }

    public function update(Request $request, $session)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|integer|max:1|min:0',
        ]);

        $update = Session::findOrFail($session);

        $update->name = $request->name;
        $update->status = $request->status;

        $update->update();

        if ($update) {
            return redirect()->back();
        } else abort('404');
    }

    public function delete($session)
    {
        $delete = Session::findOrFail($session);
        $delete->delete();
        if ($delete) {
            return redirect()->back();
        } else abort('404');
    }
}
