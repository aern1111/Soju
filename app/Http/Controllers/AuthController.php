<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phoneNumber' => 'required|string',
        ]);

        $user = User::create([
            'firstName' => $validate['firstName'],
            'lastName' => $validate['lastName'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'phoneNumber' => $validate['phoneNumber'],
        ]);

        $token = $user->createToken('myDevice')->plainTextToken;
        $respone = [
            'user' => $user,
            'token' => $token,
        ];

        return response($respone);
    }
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where('email', $validate['email'])->first();
        if (!$user || !Hash::check($validate['password'], $user->password)) {
            $response = [
                'message' => 'Email or Password incorrect',
            ];
            return response($response);
        } else {
            $user->tokens()->delete();
            $token = $user->createToken('myDevice')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
            ];
            return response($response);
        }
    }

    public function logout(){
        auth()->user->tokens()->delete();

        $respone = [
            'message'=> 'Success'
        ];
        return $respone;
    }
}
