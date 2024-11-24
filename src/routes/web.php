<?php

use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProfileController;
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
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/missions', [MissionController::class, 'index'])->middleware('can:view mission')->name('missions.index');
    Route::get('/missions/create', [MissionController::class, 'create'])->middleware('can:create mission')->name('missions.create');
    Route::post('/missions', [MissionController::class, 'store'])->middleware('can:create mission')->name('missions.store');
    Route::get('/missions/{mission}/edit', [MissionController::class, 'edit'])->middleware('can:edit mission')->name('missions.edit');
    Route::put('/missions/{mission}', [MissionController::class, 'update'])->middleware('can:edit mission')->name('missions.update');
    Route::get('/missions/{mission}', [MissionController::class, 'show'])->middleware('can:view mission')->name('missions.show');
    Route::delete('/missions/{mission}', [MissionController::class, 'destroy'])->middleware('can:delete mission')->name('missions.destroy');
});
require __DIR__.'/auth.php';
