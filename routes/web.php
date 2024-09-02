<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SponsorshipController;
use App\Models\Doctor;


//Rotta post login or guest
Route::get('/', function () {
    // Recupera tutti i dottori dal database
    $doctors = Doctor::with('user')->get();

    //Passa i dati alla vista
    return view('welcome', ['doctors' => $doctors]);
})->name('home');

// rotta show del guest
Route::get('/guest/doctor/{id}', function ($id) {
    // Recupera il dottore specifico dal database
    $doctor = Doctor::with('user')->findOrFail($id);

    // Passa i dati alla vista
    return view('guest.doctor.show', ['doctor' => $doctor]);
})->name('guest.doctor.show');


//Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Autenticato, rotte dei dottori, reviews, profili e sponsor
Route::middleware('auth')->group(function () {
    Route::resource('doctors', DoctorController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('sponsorships', SponsorshipController::class);

    // Route::get('admin/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    // Route::resource('admin/doctors', DoctorController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
