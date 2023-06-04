<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('panel.user.index', compact('users'));
    }
    public function UpdateUser(Request $request,$id)
    {
        $user = User::find($id);
        $user->status = $request->status;
        $user->role = $request->role;
        $user->save();
    }
    public function list()
    {
        $users = User::all();
        return $users;
    }
    public function settings()
    {
        return view('panel.user.settings');
    }
    public function update_settings(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->hasFile('image')) {
            $file = $request->image->store('images', 'public');
            $user->image= 'storage/'.$file;
        }
        $user->fill($request->only(['name', 'phone', 'email']));
        $user->address = $request->address;
        $user->save();
        return redirect()->back();
    }
}
