<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UpdateProfileController extends Controller
{
    public function update(UpdateProfileRequest $request){
        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return response()->json([
            'message' => 'Profile updated successfully 2',
            'user' => new ProfileResource($user),
        ], Response::HTTP_OK);
    }
}
