<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    // token based api
    public function fetchCustomers(Request $request)
    {
        $customers = Customer::with(['userData']);

        if ($request->has(['offset', 'limit'])) {
            $offset = $request->query('offset');
            $limit = $request->query('limit');

            $customers->offset($offset)->limit($limit);
        }

        $customersList = $customers->get();

        return response()->json([
            'customersList' => $customersList
        ], 200);
    }


    public function customerProfileDetails(Request $request)
    {
        $customerData = Customer::findOrFail($request->id);

        return response()->json([
            'customerDetails' => $customerData
        ], 200);
    }
}
