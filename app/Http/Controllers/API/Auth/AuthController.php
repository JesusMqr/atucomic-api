<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function Login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required",
            "device_name" => "required",
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json([
                'message'=>'The credentials are incorrect'//422
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'data'=>[
                'token'=>$user->createToken($request->device_name)->plainTextToken,
            ]
        ],Response::HTTP_OK);
    }

    public function Register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed',
            'device_name'=>'required',
        ]);

        $user = User::create($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'data'=>[
                'token'=>$token,
            ]
        ],Response::HTTP_CREATED);
    }

    public function Logout(Request $request){
        $request->user()->currentAccessToken()->delete(); // Revoca el token actual
        return response()->json([
           'message'=>'Successfully logged out'
        ], Response::HTTP_OK);
    }


}
