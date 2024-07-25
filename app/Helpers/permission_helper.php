<?php

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

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
