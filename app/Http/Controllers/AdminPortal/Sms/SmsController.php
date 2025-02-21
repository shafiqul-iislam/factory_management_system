<?php

namespace App\Http\Controllers\AdminPortal\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.sms.sms_templates');
    }
}
