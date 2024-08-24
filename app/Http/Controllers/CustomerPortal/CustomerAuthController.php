<?php

namespace App\Http\Controllers\CustomerPortal;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{

    public function auth()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'Already Logged In');
        } else {
            return view('auth.customer.login');
        }
    }

    // customer login
    public function authLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('customer')->attempt($request->only(['email', 'password']))) {

            // keep track of customer last login time
            $customer = Auth::guard('customer')->user();
            $customer->last_login_time = now();
            $customer->save();

            // return redirect()->intended('/customer-portal/home');
            return redirect('/customer-portal/home');
        }

        // return back()->withInput($request->only('email', 'remember'));
        return back()->with('error', 'Failed to Login. Please try again.')->withInput($request->only('email', 'remember'));
    }


    // customer logout
    public function authLogout()
    {
        Auth::guard('customer')->logout();
        return redirect('/customer-login');
    }

    // customer register
    public function customerSignup()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'Already Logged In');
        } else {
            return view('auth.customer.register');
        }
    }

    // customer register
    public function customerSignupStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:customers',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6'
        ]);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();

        Auth::guard('customer')->login($customer);

        return redirect('/customer-portal/home');
    }
}
