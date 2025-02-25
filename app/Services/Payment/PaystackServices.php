<?php

namespace App\Services\Payment;

class PaystackServices
{

    public function processPayment($paymentData)
    {

        $url = "https://api.paystack.co/transaction/initialize";
        $details = [
            'email' => $paymentData['customer_email'],
            'amount' => $paymentData['amount'] * 100, // Convert to kobo
            'callback_url' => url('customer-portal/paystack-success'),
        ];

        $secretKey = 'sk_test_e44613587cfbbbc43c436b90ae96949dd89b4903';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $secretKey,
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($details));

        $response = curl_exec($ch);
        curl_close($ch);

        $responseArray = json_decode($response, true);

        return $responseArray;
    }
}
