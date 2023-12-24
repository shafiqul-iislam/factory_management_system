<?php

namespace App\Http\Controllers\AdminPortal\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.products.all');
    }
}
