<?php

namespace App\Services\Notification\Sms;


class BulkSmsBDServices
{
    public function sendSms($smsAttributes, $smsData)
    {
        // Build the API URL and payload
        $apiUrl = 'http://bulksmsbd.net/api/smsapi';
        $payload = [
            "api_key" => $smsAttributes['api_key'],
            "senderid" => $smsAttributes['senderid'],
            "number" => $smsData['phone'],
            "message" => $smsData['message'],
        ];

        // Initialize cURL and set options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseArray = json_decode($response, true);
    }
}
