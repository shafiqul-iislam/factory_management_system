<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerAuthController extends Controller
{
    public function auth()
    {
        return view('auth.customer.login');
    }
}
