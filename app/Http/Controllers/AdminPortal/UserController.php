<?php

namespace App\Http\Controllers\AdminPortal;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.users.all');
    }


    public function add(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
        ]);

        $addUser = new User;
        $addUser->name = $request->name;
        $addUser->username = $request->username;
        $addUser->email = $request->email;
        $addUser->password = $request->password;
        $addUser->phone = $request->phone;
        $addUser->address = $request->address;
        $addUser->user_for = $request->user_for;
        $addUser->role = $request->role;
        $addUser->status = ($request->status == 'on') ? 1 : 0;

        $loginUserData = auth()->user();
        $addUser->created_by_id = $loginUserData->id;
        $addUser->created_by_username = $loginUserData->name;
        $response = $addUser->save();

        if ($response) {
            return redirect('/users')->with('success', 'Successfuly Added');
        } else {
            return redirect('/users')->with('error', 'Oops Something Wrong');
        }
    }
}
