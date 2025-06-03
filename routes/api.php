<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReturnReportApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoundItemApiController;
use App\Http\Controllers\Api\LostApiController;



Route::get('/signin', function (Request $request) {
    return response()->json(['message'=>'Unauthorized'], 401);
});

Route::post('/signup',[AuthController::class, 'signup']);
Route::post('/signin',[AuthController::class, 'signin'])->name('signin');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/returnReport', [ReturnReportApiController::class, 'index']);
    Route::get('/founditems', [FoundItemApiController::class, 'indexApi']);
});



Route::get('/lostitems', [LostApiController::class, 'indexApi']);

