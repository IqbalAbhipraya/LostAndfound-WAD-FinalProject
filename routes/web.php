<?php

use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/founditems', [FoundItemController::class, 'index'])->name('found.index');
    Route::get('/founditems/details/{id}', [FoundItemController::class, 'show'])->name('found.show');
    Route::get('/return-report', [ReturnReportController::class, 'index'])->name('return.index');
    Route::get('/founditems/create', [FoundItemController::class, 'create'])->name('found.create');
    Route::post('/founditems', [FoundItemController::class, 'store'])->name('found.store');
});


require __DIR__.'/auth.php';
