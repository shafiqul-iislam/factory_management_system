<?php

namespace App\Http\Controllers\AdminPortal\Role;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.roles.all');
    }


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addRole = new Role;
            $addRole->name = strtolower($request->name);
            // $addRole->guard_name = 'sanctum';
            $response = $addRole->save();

            if ($response) {
                return redirect('/roles')->with('success', 'Successfully Added');
            } else {
                return redirect('/roles')->with('error', 'Oops!, Something Wrong');
            }
        }
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('roles')->ignore($request->id)],
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            $addRole = Role::findOrFail($request->id);
            $addRole->name = strtolower($request->name);
            $response = $addRole->save();

            if ($response) {
                return redirect('/roles')->with('success', 'Successfully Updated');
            } else {
                return redirect('/roles')->with('error', 'Oops!, Something Wrong');
            }
        }
    }

    public function delete($id)
    {
        $deleteRole = Role::findOrFail($id)->delete();

        if ($deleteRole) {
            return redirect('/roles')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/roles')->with('error', 'Oops!, Something Wrong');
        }
    }

    // roles dataTables fetch by ajax
    public function serverSideAllRoles(Request $request)
    {
        $columns = array(
            0 => 'id',
        );

        $query = Role::orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));

        $totalRecords = $query->count();
        $totalFiltered = $totalRecords;

        $query->offset($request->input('start'))->limit($request->input('length'));
        $roles = $query->get();

        $rows = [];
        if (isset($roles)) {
            foreach ($roles as $role) {

                $actions = '<div class="d-flex align-item-center justify-content-end">                
                    <a href="#" class="p-1 me-2 role_edit_btn" data-role-id="' . $role->id . '" data-role-name="' . $role->name . '" data-bs-toggle="modal" data-bs-target=".update_role_modal">
                        <i class="bx bx-edit-alt text-info fs-7 me-1"></i>
                    </a>

                    <a href="#" class="p-1">
                    <form action="' .  url('roles/delete', [$role->id]) . '" method="POST">
                    ' . method_field("DELETE") . '
                    ' . csrf_field() . '
                        <i class="bx bx-trash text-danger me-1 fs-7 remove"></i>
                    </form>
                    </a> </div>';

                $permissions = '<a href="' . url('roles/permissions', [$role->id]) . '" class="text-success fs-6 fw-bold">
                     Set Permissions
                     </a>';

                $td = [];
                $td[] = $role->id;
                $td[] = $role->name;
                $td[] = $permissions;

                $td[] =  date('Y-m-d', strtotime($role->created_at));
                $td[] = $actions;
                $rows[] = $td;
            }
        }

        $json_data = array(
            "draw" => intval($request->draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $rows,
        );
        echo json_encode($json_data);
    }
}
