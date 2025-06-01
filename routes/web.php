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
    Route::get('/founditems/create', [FoundItemController::class, 'create'])->name('found.create');
    Route::post('/founditems', [FoundItemController::class, 'store'])->name('found.store');
    Route::get('/founditems/{id}/edit', [FoundItemController::class, 'edit'])->name('found.edit');
    Route::put('/founditems/{id}', [FoundItemController::class, 'update'])->name('found.update');
    Route::delete('/founditems', [FoundItemController::class, 'destroy'])->name('found.destroy');

    Route::get('/return-report', [ReturnReportController::class, 'index'])->name('return.index');
});


require __DIR__.'/auth.php';
