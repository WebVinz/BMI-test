<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\TestEmailController;
use App\Http\Controllers\HasilKesehatanMail;

Route::post('/kirim-hasil', [HasilKesehatanMail::class, 'kirimHasil'])->name('kirim.hasil');
Route::get('/test-email', [TestEmailController::class, 'kirim']);

Route::get('/', [KesehatanController::class, 'index'])
    ->name('form'); // Tanpa auth

Route::post('/hitung', [KesehatanController::class, 'hitung'])->name('hitung');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
