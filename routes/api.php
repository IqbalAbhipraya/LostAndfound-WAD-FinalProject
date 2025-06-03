<?php


use App\Http\Controllers\Api\ReturnReportApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoundItemApiController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/returnReport', [ReturnReportApiController::class, 'index']);

Route::get('/founditems', [FoundItemApiController::class, 'indexApi']);

