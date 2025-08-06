<?php

namespace App\Http\Controllers;

use App\Models\MobileOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
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

            return $this->createOTP($mobile);
        } else {
            return response()->json(["success" => 0, "message" =>  $validator->errors()->first()]);
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

            $mobile = $request->mobile;

            $user = User::create([
                'mobile' => $mobile,
                'name' => $request->name,
                'username' => $request->username,
                'dob' => $request->year . "-" . $request->month,
            ]);

            $this->createOTP($mobile);

            $data = array(
                'success' => 1,
                'message' => "OTP sent Succesfully",
            );
        } else {
            $data = array("success" => 0, "message" =>  $validator->errors()->first());
        }

        return response()->json($data);
    }

    public function createOTP($mobile)
    {
        $mobile_otp = MobileOtp::where('mobile_number', $mobile)->where('expires_at', '>=', Carbon::now())->first();
        if ($mobile_otp) {
            return array("success" => 0, "message" =>  "Please wait few seconds");
        }

        if (app()->environment() == 'local') {
            $otp = '12345';
        } else {
            $otp = rand(10000, 99999);
        }

        $expires_at = Carbon::now()->addMinutes(5);

        $mobile_otp = MobileOtp::updateOrCreate(
            ['mobile_number' => $mobile],
            [
                'mobile_number' => $mobile,
                'otp_value' => $otp,
                'expires_at' => $expires_at,
            ]
        );

        return array("success" => 1, "message" =>  "OTP sent Succesfully");
    }

    public function otp_verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'otp' => 'required',
        ]);

        if (!$validator->fails()) {
            $otp = $request->otp;
            $mobile = $request->mobile;

            $user = User::where('mobile', $mobile)->first();

            if (!$user) {
                return response()->json(['success' => 0, 'message' => 'Invalid Mobile Number']);
            }

            $mobile_otp = MobileOtp::where('mobile_number', $mobile)->where('otp_value', $otp)->where('expires_at', '>=', Carbon::now())->first();

            if (!$mobile_otp) {
                return response()->json(['success' => 0, 'message' => 'Invalid OTP']);
            }

            $token = JWTAuth::fromUser($user);

            MobileOtp::where('mobile_number', $mobile)->delete();

            $data = array(
                'success' => 1,
                'message' => "Login Succesfully",
                'token' => $token
            );
        } else {
            $data = array("success" => 0, "message" =>  $validator->errors()->first());
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
