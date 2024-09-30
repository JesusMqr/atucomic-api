<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\API\Auth\ChangePasswordController;
use App\Http\Controllers\Api\Content\SerieController;
use App\Http\Controllers\Api\Content\ChapterController;
use App\Http\Controllers\API\User\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);

Route::prefix('public')->group(function(){
    Route::get('series',[SerieController::class,'index']);
    Route::get('series/{series}',[SerieController::class,'show']);
    Route::get('chapters/{chapter}',[ChapterController::class,'show']);

});
Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('profile',[UserProfileController::class,'profile']);
    Route::put('profile', [UserProfileController::class, 'updateProfile']);
    Route::put('change-password', [ChangePasswordController::class, 'changePassword']);

    require __DIR__.'/api_v1.php';
});
