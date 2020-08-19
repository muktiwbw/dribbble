<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;

class UserController extends Controller
{
    public function login(Request $request) {
        $user = User::where(['email' => $request->email])->first();
    
        if (!$user || !Auth::attempt($request->only('email', 'password'))) {
            return json_encode([
                'status' => 'fail',
                'message' => 'Incorrect email or password'
            ]);
        }
    
        try {
            $token = $user->createToken('accessToken')->accessToken;
        
            return response($token)->cookie('token', $token);
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'fail',
                'message' => $th
            ]);
        }
    }

    public function register(Request $request) {
        if ($request->password !== $request->passwordConfirm) {
            return json_encode([
                'status' => 'fail',
                'message' => 'Password dont\'t match'
            ]);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $token = $user->createToken('accessToken')->accessToken;

            return response($token)->cookie('token', $token);
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'fail',
                'message' => $th
            ]);
        }
    }

    public function logout() {
        return response('logged out')->cookie('token', 'logged out', 1/60);
    }
}