<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAPIRequest;
use App\Http\Requests\RegisterAPIRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends ApiBaseController
{
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return ['message'=>'Logged out'];
    }

    public function register(RegisterAPIRequest $request)
    {
        $post_data = $request->validated;

        $user = User::create([
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password']),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(LoginAPIRequest $request){
        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json([
                    'message' => 'Login information is invalid.'
                ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
