<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        $user = $request->user();

        if(!Hash::check($request->password,$user->password)){
            return response()->json([
                'errors' =>'Current password is incorrect',
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
           'message' => 'Password has been changed successfully'
        ],Response::HTTP_OK);

    }
}
