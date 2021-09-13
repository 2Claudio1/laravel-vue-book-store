<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(Request $request)
    {
        //$email = Auth::user()->email;
        //$user = User::where('email', $email)->first();

        //$user = $request->user();
        if (Hash::check($request->oldPassword, $request->user()->password)) {

            $user = $this->me($request);
            
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return response()->json(['message' => 'Password changed'], 200);

        } else {
            return response()->json(['message' => 'Wrong password.'], 401);
        }
    }
}
