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

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
        ]);

        if (!$validator->fails()) {

            $mobile = $request->mobile;
            $user = User::where('mobile', $mobile)->first();

            if (!$user) {
                return response()->json(['success' => 0, 'message' => 'Mobile number not registered']);
            }

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => 1,
                'token' => $token,
                'user' => $user
            ]);

        } else {
            return response()->json(["success" => "0", "message" =>  $validator->errors()->first()]);
        }


    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|unique:users',
            'name' => 'required',
            'username' => 'required|unique:users',
            'month' => 'required',
            'year' => 'required',
        ]);

        if (!$validator->fails()) {

            $user = User::create([
                'mobile' => $request->mobile,
                'name' => $request->name,
                'username' => $request->username,
                'dob' => $request->year . "-" . $request->month,
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
