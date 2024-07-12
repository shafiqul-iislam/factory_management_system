<?php

namespace App\Http\Controllers\AdminPortal\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function permissions($id)
    {
        $data['permissions'] = [];        
        $data['role'] = Role::findOrFail($id);

        $permissions = $data['role']->permissions;
        foreach ($permissions as $permission) {
            $data['permissions'][$permission->name] = $permission->name;
        }
        
        $data['pageTitle'] = "Permissions";
        $data['pageSubTitle'] = "All Permissions";

        return view('theme.admin_portal.roles.all_permissions', $data);

        // $permission = Role::findOrFail($id);
        // return view('theme.roles.all_permissions', ['permission' => $permission]);
    }

    public function updatePermission(Request $request)
    {
        $role = $request->role;
        $permissionName = $request->permission;

        $permissionRes = Permission::where('name', '=', $permissionName)->count();
        if ($permissionRes <= 0) { //if not exist
            $permission = Permission::create(['name' => $permissionName]); //create permission in db
        } else {
            $permission = Permission::getPermissions(['name' => $permissionName])->first();
        }

        $role = Role::find($role);
        $roleHasPermission = $role->hasPermissionTo($permissionName);
        if ($roleHasPermission) {
            $role->revokePermissionTo($permissionName);
        } else {
            $permission->assignRole($role);
        }

        echo json_encode(1);
    }
}
