<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

if (!function_exists('checkPermission')) {
    function checkPermission($permissionName)
    {
        return 'permissions';
    }
}
