<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.hrm.employees.all');
    }
}
