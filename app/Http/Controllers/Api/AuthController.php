<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Auth::user();
        } else {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();  //check if Auth::logout(); works
        return response()->json(['message' => 'User session closed'], 200);
    }

    public function me(Request $request)
    {
        return $request->user();
        // Alternative:
        // return Auth::user();
    }
}
