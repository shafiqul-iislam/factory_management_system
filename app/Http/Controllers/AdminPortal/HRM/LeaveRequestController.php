<?php

namespace App\Http\Controllers\AdminPortal\HRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaveRequestController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.hrm.leave_request.all');
    }
}
