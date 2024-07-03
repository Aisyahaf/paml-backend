<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'status' => 'Registration success!',
            'token_type' => 'Bearer',
            'access_token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)){
            $user = $request->user();
            if($user->tokens){
                $user->tokens()->delete();
            }

            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'status' => 'Login success!',
                'token_type' => 'Bearer',
                'access_token' => $token,
            ], 201);
        }else{
            return response()->json([
                'status' => 'Login fail!',
            ], 401);
        }
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => 'Logout success!',
        ], 200);
    }
}
