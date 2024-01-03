<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (empty($credentials['email']) || empty($credentials['password'])) {
            return response()->json([
                'message' => 'email and password are required',
            ], 400);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'credentials do not match our records.',
            ], 401);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'success login',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'success logout'
        ]);
    }
}

