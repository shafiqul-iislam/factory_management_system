<?php

namespace App\Http\Controllers\AdminPortal\Email;

use App\Jobs\SendEmail;
use App\Mail\SendingMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class EmailController extends Controller
{
    public function sendCustomEmail()
    {
        // $config = [
        //     'driver' => 'smtp',
        //     'host' => $emailSettings->host,
        //     'port' => intval($emailSettings->host_port), // Default SMTP port
        //     'from' => ['address' => $emailSettings->username, 'name' => $generalSettings->name ?? 'ISP Services'],
        //     'encryption' => $emailSettings->encryption, // SSL/TLS encryption
        //     'username' => $emailSettings->username,
        //     'password' => $emailSettings->password,
        //     'sendmail' => '/usr/sbin/sendmail -bs',
        //     'pretend' => false,
        // ];
        // // Apply the SMTP settings
        // Config::set('mail', $config);


        // $config = [
        //     'driver' => 'smtp',
        //     'host' => 'smtp.gmail.com',
        //     'port' => '587', // Default SMTP port
        //     'from' => ['address' => 'shafiqulislam78652@gmail.com', 'name' => 'Yellow Factory'],
        //     'encryption' => 'tls', // SSL/TLS encryption
        //     'username' => 'shafiqulislam78652@gmail.com',
        //     'password' => 'ppcmjenmdhlcykdx',
        //     'sendmail' => '/usr/sbin/sendmail -bs',
        //     'pretend' => false,
        // ];

        // // Apply the SMTP settings
        // Config::set('mail', $config);

        // $details = [
        //     'name' => 'John Doe',
        //     'message' => 'This is a test email from Laravel.'
        // ];

        // Mail::to('shafiq@gmail.com')->send(new SendingMail($details));


        $details = [
            'name' => 'John Doe',
            'message' => 'This is a test email from Laravel.'
        ];

        $emailResponse = dispatch(new SendEmail($details))->delay(now()->addSeconds(30));

        return back()->with('success', 'Email sent successfully.');
    }
}
