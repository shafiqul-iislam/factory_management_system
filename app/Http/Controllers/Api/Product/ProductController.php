<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;

class ProductController extends Controller
{
    // basic auth api
    public function fetchAllProducts(Request $request)
    {
        $allProducts = Product::all();

        // if ($request->has(['offset', 'limit'])) {
        //     $offset = $request->query('offset');
        //     $limit = $request->query('limit');

        //     $customers->offset($offset)->limit($limit);
        // }

        return response()->json([
            'allProducts' => $allProducts
        ], 200);
    }


    // public function customerProfileDetails(Request $request)
    // {
    //     $customerData = Customer::findOrFail($request->id);

    //     return response()->json([
    //         'customerDetails' => $customerData
    //     ], 200);
    // }
}
