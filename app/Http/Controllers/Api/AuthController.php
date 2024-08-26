<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function authLogin(Request $request)
    {
        dd($request);

        if (Auth::guard('sanctum')->attempt($request->only(['email', 'password']))) {

            dd('hello api world');

            $user = Auth::guard('sanctum')->user();
            $tokenResult = $user->createToken('create_token');
            $token = $tokenResult->plainTextToken;

            // $expiresAt = now()->addDays(3);

            // $user->tokens()->where('id', $tokenResult->accessToken->id)->update(['expires_at' => $expiresAt]);

            return response()->json(['userData' => $user, 'token' => $token], 200);
        }
    }
}
