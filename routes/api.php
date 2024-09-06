<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SpecializationController;

// Rotte API
Route::middleware('api')->group(function () {
    // Definisci qui le tue rotte API

    Route::post('/messages', [MessageController::class, 'store']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/doctors', [DoctorController::class, 'index']);

    // Questo serve per far funzionare il search della spec, altrimenti da sempre la lista di tutti... 1 ora per sta riga
    Route::get('/doctors', [DoctorController::class, 'getDoctors']);

    // Rotta per ottenere i dettagli di un singolo dottore
    // Route::get('/doctors/{id}', [DoctorController::class, 'show']);
    Route::get('/doctors/{slug}', [DoctorController::class, 'show']);

    Route::get('/specializations', [SpecializationController::class, 'index']);
});
