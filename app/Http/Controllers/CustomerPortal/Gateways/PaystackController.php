<?php

namespace App\Http\Controllers\CustomerPortal\Gateways;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaystackController extends Controller
{
    public function success(Request $request)
    {
        dd($request->all());
    }
}
