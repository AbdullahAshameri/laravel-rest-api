<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    use GeneralTrait;
    public function login(Request $request) {

        try {

            $rules = [
                "email" => "required|exists:admins,email",
                "password" => "required"
            ];
            //validation
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);
                
            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $data = Auth::guard('admin-api')->user();
            $data -> api_token = $token;
            
            //return token
                return $this->returnData('admin', $data);
                // return $this->returnData('admin', $token);
                
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function logout(Request $request) 
    {
        $token = $request->header('auth-token');

        if ($token) {
            try {
                // invalidate() => إبطال (حذف) التوكن الحالي وإنهاء جلسة المستخدم
                JWTAuth::setToken($token)->invalidate(); // Logout
            }catch(TokenInvalidException $e) {
                return $this->returnError('', 'Token Invald . or Not Provider');
            }
            return $this->returnSuccessMessage('Logged Out Successfully');

        }else {
             $this->returnError('', 'Token Invald . or Not Provider');
        }
    }
}
