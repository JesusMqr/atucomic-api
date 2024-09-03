<?php

use App\Http\Controllers\Api\Content\ChapterController;
use App\Http\Controllers\Api\Content\ImageController;
use App\Http\Controllers\Api\Content\SerieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    Route::apiResource('series', SerieController::class);
    Route::apiResource('chapters',ChapterController::class);
    Route::apiResource('images', ImageController::class);
});
