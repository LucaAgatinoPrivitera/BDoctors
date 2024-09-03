<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;

// Rotte API
Route::middleware('api')->group(function () {
    // Definisci qui le tue rotte API

    Route::get('/doctors', [DoctorController::class, 'index']);

    // Rotta per ottenere i dettagli di un singolo dottore
    Route::get('/doctors/{id}', [DoctorController::class, 'show']);
});
