<?php

namespace App\Jobs;

use App\Mail\SendingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $config = [
            'driver' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => '587', // Default SMTP port
            'from' => ['address' => 'shafiqulislam78652@gmail.com', 'name' => 'Yellow Factory'],
            'encryption' => 'tls', // SSL/TLS encryption
            'username' => 'shafiqulislam78652@gmail.com',
            'password' => 'ppcmjenmdhlcykdx',
            'sendmail' => '/usr/sbin/sendmail -bs',
            'pretend' => false,
        ];

        // Apply the SMTP settings
        Config::set('mail', $config);


        $toEmail = $this->details['toEmail'];

        $emailDetails = [
            'name' => $this->details['name'],
            'message' => $this->details['message'],
        ];

        Mail::to($toEmail)->send(new SendingMail($emailDetails));
    }
}
