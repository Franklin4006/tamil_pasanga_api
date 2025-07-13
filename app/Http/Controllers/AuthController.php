<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|unique:users',
            'name' => 'required',
            'username' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if (!$validator->fails()) {

            $user = User::create([
                'mobile' => $request->mobile,
                'name' => $request->name,
                'username' => $request->username,
                'dob' => $request->month."-".$request->year,
            ]);

            $token = JWTAuth::fromUser($user);

            $data = array(
                'success' => 1,
                'message' => "User Register Succesfully",
                'token' => $token,
                'user' => $user
            );
        } else {
            $data = array("success" => "0", "message" =>  $validator->errors()->first());
        }

        return response()->json($data);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function users()
    {
        return response()->json(['users' => User::all()]);
    }
}
