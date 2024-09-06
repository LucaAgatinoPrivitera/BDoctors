<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Api\ReviewController;

// Rotte API
Route::middleware('api')->group(function () {
    // Definisci qui le tue rotte API

    Route::post('/doctors/{doctorId}/messages', [MessageController::class, 'store']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/doctors', [DoctorController::class, 'index']);

    // Rotta per ottenere i dettagli di un singolo dottore
    Route::get('/doctors/{id}', [DoctorController::class, 'show']);
});
