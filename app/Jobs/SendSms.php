<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Services\Notification\Sms\BulkSmsBDServices;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $smsData;

    public function __construct($smsData)
    {
        $this->smsData = $smsData;
    }


    public function handle(): void
    {
        // if($smsSettings->sms_type == 'bulk_sms_bd') {

        $smsAttributes = [
            // 'api_key' => $smsSettings->api_key,
            // 'senderid' => $smsSettings->senderid,

            'api_key' => 'rfg1fgsdf545jg7kl5',
            'senderid' => '5143578485',
        ];

        $smsData = [
            'phone' => $this->smsData['phone'],
            'message' => $this->smsData['message'],
        ];

        $bulkSmsServices = new BulkSmsBDServices;
        $response = $bulkSmsServices->sendSms($smsAttributes, $smsData);

        // }
    }
}
