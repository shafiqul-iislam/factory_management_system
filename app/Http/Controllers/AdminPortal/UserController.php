<?php

namespace App\Http\Controllers\AdminPortal;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.users.all');
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addUser = new User;
            $addUser->role = $request->role;
            $addUser->profile_type = $request->profile_type;
            $addUser->name = $request->name;
            $addUser->username = $request->username;
            $addUser->email = $request->email;
            $addUser->password = $request->password;
            $addUser->phone = $request->phone;
            $addUser->address = $request->address;
            $addUser->profile_status = ($request->profile_status == 'on') ? 1 : 0;

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

    public function edit($id)
    {
        $data['userData'] = User::findOrFail($id);
        return view('theme.admin_portal.users.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => ['required', Rule::unique('users')->ignore($request->id)],
            'email' => ['required', Rule::unique('users')->ignore($request->id)],
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $updateUser = User::findOrFail($request->id);
            $updateUser->role = $request->role;
            $updateUser->profile_type = $request->profile_type;
            $updateUser->name = $request->name;
            $updateUser->username = $request->username;
            $updateUser->email = $request->email;
            $updateUser->phone = $request->phone;
            $updateUser->address = $request->address;
            $updateUser->profile_status = ($request->profile_status == 'on') ? 1 : 0;
            $response = $updateUser->save();

            if ($response) {
                return redirect('/users')->with('success', 'Successfuly Updated');
            } else {
                return redirect('/users')->with('error', 'Oops Something Wrong');
            }
        }
    }


    public function delete($id)
    {
        $deleteUser = User::findOrFail($id)->delete();
        if ($deleteUser) {
            return redirect('/users')->with('success', 'Successfuly Deleted');
        } else {
            return redirect('/users')->with('error', 'Oops Something Wrong');
        }
    }


    // users dataTables fetch by ajax
    public function serverSideAllUsers(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = User::orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $users = $query->get();

        $rows = [];
        if (isset($users)) {
            foreach ($users as $user) {
                $actions = '<div class="d-flex align-item-center justify-content-end">                
                <a href="' . url('users/edit', [$user->id]) . '" class="p-1 me-2">
                   <i class="bx bx-edit-alt fs-7 text-info me-1"></i>
                </a>
                    <a href="#" class="p-1">
                    <form action="' .  url('users/delete', [$user->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash fs-7 me-1 text-danger remove"></i>
                    </form>
                    </a> </div>';

                $td = [];
                $td[] = $user->id;
                $td[] = $user->username;
                $td[] = $user->role;
                $td[] = $user->profile_type;
                $td[] = $user->phone;
                $td[] = $user->email;
                $td[] = $user->profile_status;
                $td[] = $user->created_by_username;
                $td[] =  date('Y-m-d', strtotime($user->created_at));
                $td[] = $actions;
                $rows[] = $td;
            } //end of foreach
        }
        $json_data = array(
            "draw" => intval($request->draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $rows,
        );
        return response()->json($json_data);
    }
}
