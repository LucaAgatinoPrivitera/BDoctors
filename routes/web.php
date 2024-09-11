<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SponsorshipController;
use App\Models\Doctor;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\BraintreeController;


// Modifica la rotta principale per reindirizzare alla pagina di registrazione
Route::get('/', function () {
    return redirect()->route('register');
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
    // Route::resource('doctors', DoctorController::class);
    Route::resource('doctors', DoctorController::class);
    // Aggiungi questa route per gestire lo show con lo slug
    Route::get('doctors/{doctor:slug}', [DoctorController::class, 'show'])->name('doctors.show');

    Route::resource('reviews', ReviewController::class);
    Route::resource('sponsorships', SponsorshipController::class);
    Route::resource('specializations', SpecializationController::class);
    Route::resource('messages', MessageController::class);
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');

   
    
    Route::get('payment', [BraintreeController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('payment', [BraintreeController::class, 'handlePayment'])->name('payment.handle');
    Route::get('payment/success', function () {
      return view('payment-success');
    })->name('payment.success');

    // Rotta per visualizzare tutte le recensioni di un medico
    Route::get('doctors/{doctor}/reviews', [DoctorController::class, 'showReviews'])->name('doctors.reviews');
    // Rotta per visualizzare tutti i messaggi di un medico
    Route::get('doctors/{doctor}/messages', [DoctorController::class, 'showMessages'])->name('doctors.messages');
    


    // Route::get('admin/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    // Route::resource('admin/doctors', DoctorController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



