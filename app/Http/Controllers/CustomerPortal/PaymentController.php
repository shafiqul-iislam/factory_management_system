<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\Payment\PaystackServices;
use App\Services\Payment\SSLCommerzServices;

class PaymentController extends Controller
{
    public function __construct(
        private PaystackServices $paystackServices,
        private SSLCommerzServices $sslcommerzServices
    ) {
        //
    }

    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'payment_method' => 'required',
            // 'payment_amount' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return redirect()->back()->with('error', $error);
        } else {

            // if($request->payment_method == 1){ // sslcommerz


            $paymentData = [
                // 'amount' => $request->payment_amount,
                'amount' => 100,
                'customer_id' => auth()->user('customer')->id,
                'customer_email' => auth()->user('customer')->email
            ];

            $response = $this->sslcommerzServices->processPayment($paymentData);

            if (
                isset($response['status']) && $response['status'] == 'SUCCESS'
            ) {
                return redirect()->to($response['GatewayPageURL']);
            } else {
                return response()->json(['error' => 'SSLCommerz payment gateway error.']);
            }


            // }

            // else if ($request->payment_method == 2) { // paystack
            //

            // $paymentData = [
            //     // 'amount' => $request->payment_amount,
            //     'amount' => 100,
            //     'customer_id' => auth()->user('customer')->id,
            //     'customer_email' => auth()->user('customer')->email
            // ];

            // $response = $this->paystackServices->processPayment($paymentData);

            // if ($response['status'] == true) {
            //     return redirect($response['data']['authorization_url']);
            // } else {
            //     return redirect()->back()->with('error', $response['message']);
            // }
            // }
        }
    }
}
