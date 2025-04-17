<?php

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


// if (!function_exists('getPermissions')) {
//     function getPermissions($rolename = null)
//     {

//         //default loggedin rolename
//         $role = Auth::user()->role;

//         //cehck if rolename passed or exists
//         if (isset($rolename) && !empty($rolename)) {
//             $role = $rolename;
//         }

//         if (isset($role) && !empty($role)) {
//             $permissions = Role::find($role)->permissions;
//             $permissionNames = [];
//             foreach ($permissions as $permission) {
//                 $permissionNames[$permission->name] = $permission->name;
//             }

//             return $permissionNames;
//         }

//         return [];
//     }
// }

// if (!function_exists('checkPermission')) {
//     function checkPermission(array $userPermissions, string $permissionName)
//     {
//         // emergency only
//         // return TRUE;

//         if (is_array($userPermissions) && array_key_exists($permissionName, $userPermissions)) {
//             return true;
//         }

//         return false;
//     }
// }

if (!function_exists('getPermissions')) {
    function getPermissions($roleName = null)
    {
        //default loggedin rolename
        $userData = Auth::user();
        $roleNamesCollection = $userData->getRoleNames();

        if ($roleNamesCollection->isNotEmpty()) {
            $roleName = $roleNamesCollection->first();
        }

        if (!empty($roleName)) {

            $role = Role::where('name', $roleName)->first();

            if (isset($role)) {
                $permissions = $role->getPermissionNames();
                return $permissions;
            }
        }
        return collect();
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission(Collection $authPermissions, string $permissionName)
    {
        // emergency only
        // return TRUE;

        //check if collection contains the permission name 
        $exists = $authPermissions->contains($permissionName);
        if ($exists) {
            return TRUE;
        }
        return FALSE;
    }
}
