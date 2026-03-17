<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
     public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]); 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['success' => true, 'data' => ['user'=>$user,'access_token' => $token], 'message' => 'User registered successfully']);

    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['success' => false,
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data'=>['user' => $user, 'access_token' => $token],
            'message' => 'User logged in successfully',
        ]);
    }

   

    public function logout(Request $request)
    {
        // Auth::user()->currentAccessToken()->delete();

        return response()->json(['success' => true,'data' => null, 'message' => 'User logged out ']);

    }

    public function me(){
        return response()->json(['success' => true, 'data' => Auth::user(),'message' => 'User logged in successfully']);
    }
}
