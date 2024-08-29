<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Product\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth-login', [AuthController::class, 'authLogin'])->name('auth-login');

// token based api
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/fetch-customers', [CustomerController::class, 'fetchCustomers'])->name('fetch-customers');

    Route::get('/get-customer-details', [CustomerController::class, 'customerProfileDetails'])->name('get-customer-details');
});


// basic auth api
Route::middleware('auth.basic')->group(function () {
    Route::get('/fetch-products', [ProductController::class, 'fetchAllProducts'])->name('fetch-products');
});
