<?php

namespace App\Http\Controllers\AdminPortal\Sms;

use App\Jobs\SendSms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.sms.sms_templates');
    }


    public function sendCustomSms()
    {
        $smsData = [
            'phone' => '01317397129',
            'message' => 'Test Message From Laravel',
        ];

        $smsResponse = dispatch(new SendSms($smsData))->delay(now()->addSeconds(30));

        return back()->with('success', 'SMS sent successfully.');
    }
}
