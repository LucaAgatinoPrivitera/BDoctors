<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;

// Rotte API
Route::middleware('api')->group(function () {
    // Definisci qui le tue rotte API

    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::get('/doctors/{doctor}', [DoctorController::class, 'show']);
});
