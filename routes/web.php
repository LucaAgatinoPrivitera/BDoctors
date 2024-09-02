<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReviewController;
use App\Models\Doctor;

Route::get('/', function () {
    // Recupera tutti i dottori dal database
    $doctors = Doctor::with('user')->get();

    // Passa i dati alla vista
    return view('welcome', ['doctors' => $doctors]);
})->name('home');

Route::get('/guest/doctor/{id}', function ($id) {
    // Recupera il dottore specifico dal database
    $doctor = Doctor::with('user')->findOrFail($id);

    // Passa i dati alla vista
    return view('guest.doctor.show', ['doctor' => $doctor]);
})->name('guest.doctor.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('doctors', DoctorController::class);
    Route::resource('reviews', ReviewController::class);

    // Route::get('admin/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    // Route::resource('admin/doctors', DoctorController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
