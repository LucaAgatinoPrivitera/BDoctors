<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SpecializationController;

// Rotte API
Route::middleware('api')->group(function () {
    // Definisci qui le tue rotte API

    Route::post('/doctors/{doctorId}/messages', [MessageController::class, 'store']);
    Route::post('/doctors/{doctorId}/reviews', [ReviewController::class, 'store']);
    Route::get('/doctors', [DoctorController::class, 'index']);

    // Rotta per ottenere i dettagli di un singolo dottore
    Route::get('/doctors/{id}', [DoctorController::class, 'show']);

    Route::get('/specializations', [SpecializationController::class, 'index']);
});
