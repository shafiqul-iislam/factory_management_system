<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerHomeController extends Controller
{
    public function index()
    {
        return view('theme.customer_portal.home');
    }
}
