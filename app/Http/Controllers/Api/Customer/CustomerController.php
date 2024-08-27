<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function fetchCustomers(Request $request)
    {
        $customers = Customer::all();


        return response()->json([
            'customers' => $customers
        ], 200);
    }
}
