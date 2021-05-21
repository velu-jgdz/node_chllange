<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\ApiToken;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), 
            $rules = [
                'first_name' => 'required|min:1|max:255',
                'last_name' => 'required|min:1|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'phone' => 'required|min:10|unique:users,mobile',
                'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'mobile' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        if($user)
        {
            $token = Str::random(50);
            
            $update_token = ApiToken::create([
                'user_id' => $user->id,
                'token' => $token
            ]);

            return response()->json([
                'status' => true,
                'message' => "Register User Successfully",
                'data' => $user,
                'api_token' => $token
            ]);
        }
        else
        {
        	return response()->json([
                'status' => false,
                'message' => "Register User Not Happening",
            ]);
        }
    }

    public function login(Request $request)
    {
        if($request->mobile)
        {
            $validate = \Validator::make($request->all(), [
                'mobile' => 'required',
                'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            ]);
            if($validate->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            }
            else{
                $mobile = $request->mobile;
                $password = $request->password;
                $user = User::where('mobile', $mobile)->latest()->first();
                if($user)
                {
                    if (!Hash::check($password, $user->password)) 
                    {
                        return response()->json([
                            'status' => false,
                            'message' => "Login credentials wrong"
                        ]);
                    }
                    else
                    {
                        $checkKey = User::where('mobile', $request->mobile)->latest()->first();
                    }
                }
                else
                {
                    return response()->json([
                        'status' => false,
                        'message' => "This user not existed"
                    ]);
                }
            }
        }
        else
        {
            $validate = \Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            ]);
            if($validate->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            }
            else{
                $email = $request->email;
                $password = $request->password;
                $user = User::where('email', $email)->latest()->first();
                if($user)
                {
                    if (!Hash::check($password, $user->password)) 
                    {
                        return response()->json([
                            'status' => false,
                            'message' => "Login credentials wrong"
                        ]);
                    }
                    else
                    {
                        $checkKey = User::where('email', $request->email)->latest()->first();
                    }
                }
                else
                {
                    return response()->json([
                        'status' => false,
                        'message' => "This user not existed"
                    ]);
                }
            }
        }
        if($checkKey)
        {

            $token = Str::random(50);
            $updateToken = ApiToken::where('user_id', $checkKey->id)->first();
            if($updateToken)
            {
                $updateToken = ApiToken::where('user_id', $checkKey->id)->update(['token'=>$token]);
            }
            else
            {
                $updateToken = ApiToken::create([
                    'user_id' => $checkKey->id,
                    'token' => $token
                ]);
            }
            
            return response()->json([
                'status' => true,
                'message' => "Login User Successfully",
                'data' => $checkKey,
                'api_token' => $token
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => "Please check the registered mail or mobile"
            ]);
        }
    }
}
