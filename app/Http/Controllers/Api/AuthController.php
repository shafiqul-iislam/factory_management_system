<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authLogin(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($request->only(['email', 'password']))) {

            $user = Auth::guard('web')->user();
            $tokenResult = $user->createToken('create_token');
            $token = $tokenResult->plainTextToken;

            // $expiresAt = now()->addDays(3);
            // $user->tokens()->where('id', $tokenResult->accessToken->id)->update(['expires_at' => $expiresAt]);

            return response()->json(['userData' => $user, 'token' => $token], 200);
        }
    }
}
