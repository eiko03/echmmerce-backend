<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Rules\CheckIfUserExistsRule;


class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(LoginRequest $request){
        $request->validate([
           'email'=>new CheckIfUserExistsRule()
        ]);

        if (! $token = auth('user')->attempt($request->all()) and ! $token = auth('admin')->attempt($request->all())) {
            return response()->json(['error' => 'Email or Password is wrong'], 401);
        }

        return $this->createNewToken($token);
    }


    public function register(RegisterRequest $request) {

        $user = User::create(array_merge(
            $request->toArray(),
            ['password' => bcrypt($request->password)]
        ));


        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user->email
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
        return response()->json(auth()->user(),200);
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => is_null(auth()->user()) ? auth()->guard('admin')->user():auth()->user(),
	    'is_admin' => is_null(auth()->user()) ? 1:0
        ]);
    }

}
