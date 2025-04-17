<?php

namespace App\Http\Controllers\CustomerPortal\Gateways;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaystackController extends Controller
{
    public function success(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->back()->with('error', 'No reference found.');
        }

        // Verify payment using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/verify/" . $reference);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer sk_test_e44613587cfbbbc43c4",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseArray = json_decode($response, true);

        if ($responseArray['status'] && $responseArray['data']['status'] === 'success') {
            return redirect()->back()->with('success', 'Payment successful.');
        } else {
            return redirect()->back()->with('error', 'Payment failed.');
        }
    }
}
