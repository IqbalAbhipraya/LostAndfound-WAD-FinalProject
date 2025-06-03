<?php

use App\Http\Controllers\LostItemController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnReportController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Found items resource routes (if you still need them)
    Route::resource('/founditems', FoundItemController::class);

    Route::get('/founditems', [FoundItemController::class, 'index'])->name('found.index');
    Route::get('/founditems/details/{id}', [FoundItemController::class, 'show'])->name('found.show');
    Route::get('/founditems/create', [FoundItemController::class, 'create'])->name('found.create');
    Route::post('/founditems', [FoundItemController::class, 'store'])->name('found.store');

    Route::get('/founditems/{id}/edit', [FoundItemController::class, 'edit'])->name('found.edit');
    Route::put('/founditems/{id}', [FoundItemController::class, 'update'])->name('found.update');
    Route::delete('/founditems/{id}', [FoundItemController::class, 'destroy'])->name('found.destroy');

    Route::get('/return-report', [ReturnReportController::class, 'index'])->name('return.index');
    Route::get('/return-report-form/create/{id}', [ReturnReportController::class, 'create'])->name('return.create');
    Route::post('/return-report-form/create/{id}', [ReturnReportController::class, 'store'])->name('return.store');


    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    Route::get('/lost-items', [LostItemController::class, 'index'])->name('lost-items.index');
    Route::get('/lost-items/details/{id}', [LostItemController::class, 'show'])->name('lost-items.show');
    Route::get('/lost-items/create', [LostItemController::class, 'create'])->name('lost-items.create');
    Route::post('/lost-items', [LostItemController::class, 'store'])->name('lost-items.store');

    Route::get('/lost-items/{id}/edit', [LostItemController::class, 'edit'])->name('lost-items.edit');
    Route::put('/lost-items/{id}', [LostItemController::class, 'update'])->name('lost-items.update');
    Route::delete('/lost-items/{id}', [LostItemController::class, 'destroy'])->name('lost-items.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/return-report/{id}/edit', [ReturnReportController::class, 'edit'])->name('return.edit');
    Route::put('/return-report/{reportData}', [ReturnReportController::class, 'update'])->name('return.update');
    Route::delete('/return-report/{returnReport}', [ReturnReportController::class, 'destroy'])->name('return.delete');

});


require __DIR__.'/auth.php';
