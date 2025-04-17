<?php

namespace App\Http\Controllers\CustomerPortal\Gateways;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SSLCommerzController extends Controller
{
    //

    public function success(Request $request)
    {

        dd($request->all());
        
        //
    }

    public function failed(Request $request)
    {

        //
    }

    public function cancel(Request $request)
    {

        //
    }
}
