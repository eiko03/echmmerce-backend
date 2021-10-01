<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(LoginRequest $request){

        if (! $token = auth()->attempt($request)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }


    public function register(Request $request) {

        $user = User::create(array_merge(
            $request,
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }


    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }


    public function userProfile() {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}
