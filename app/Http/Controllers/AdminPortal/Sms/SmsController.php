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

        $smsResponse = SendSms::dispatch($smsData)->delay(1);
    }
}
