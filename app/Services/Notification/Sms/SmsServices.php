<?php

namespace App\Services\Notification\Sms;

use App\Models\SMS\SmsTemplate;
use Illuminate\Support\Facades\Log;

class SmsServices
{
    public function processSmsTemplate($smsType, $ownerData, $smsVeriables)
    {
        $variables = [
            'id' => $ownerData->id,
            'name' => $ownerData->name,
            'username' => 'admin',
            'otp' => $smsVeriables['otp'] ?? '',
        ];

        $smsTemplate = SmsTemplate::where([
            'type' => $smsType
        ])->first();

        if ($smsTemplate) {
            $template = $smsTemplate->template_text;
            $placeholders = array_map(fn($key) => '{' . $key . '}', array_keys($variables));
            $message = str_replace($placeholders, array_values($variables), $template);

            return $message;
        }

        Log::warning("SMS template not found for type '{$smsType}'");

        return false;
    }


    
}
