<?php

namespace App\Services\Payment;

class SSLCommerzServices
{

    public function processPayment($paymentData)
    {
        $post_data = [
            'store_id' => 'range6625e8ba4cf15',
            'store_passwd' => 'range6625e8ba4cf15@ssl',
            'total_amount' => 100, // Example amount
            'currency' => "BDT",
            'tran_id' => uniqid(), // Unique transaction ID
            'success_url' => url('sslcommerz-success'),
            'fail_url' => url('sslcommerz-failed'),
            'cancel_url' => url('sslcommerz-cancel'),
            'cus_name' => "Customer Name",
            'cus_email' => "customer@example.com",
            'cus_phone' => "01700000000",
            'cus_add1' => "Dhaka",
            'cus_city' => "Dhaka",
            'cus_country' => "Bangladesh",
            'shipping_method' => "NO",
            'product_name' => "Test Product",
            'product_category' => "Electronics",
            'product_profile' => "general",
        ];

        $url = 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        return $result;
    }
}
