<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\TestEmailController;

Route::get('/test-email', [TestEmailController::class, 'kirim']);

Route::get('/', [KesehatanController::class, 'index']);
Route::post('/hitung', [KesehatanController::class, 'hitung'])->name('hitung');
Route::post('/kirim-hasil', [KesehatanController::class, 'kirimHasil'])->name('kirim.hasil');
