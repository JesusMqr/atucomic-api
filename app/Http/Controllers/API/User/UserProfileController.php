<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Http;

class UserProfileController extends Controller
{
    public function Profile(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(new ProfileResource($user),Response::HTTP_OK);
    }

    public function updateProfile(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        $user = $request->user();
        $user->update($request->only(['name', 'email'])); // Asegúrate de que solo se actualicen los campos correctos.


        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => new ProfileResource($user),
        ], Response::HTTP_OK);

    }
}
