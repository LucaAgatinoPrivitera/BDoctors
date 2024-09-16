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

// Rotta show del guest per visualizzare un singolo dottore
Route::get('/guest/doctor/{id}', function ($id) {
    // Recupera il dottore specifico dal database con le relazioni necessarie
    $doctor = Doctor::with('user')->findOrFail($id);

    // Passa i dati alla vista
    return view('guest.doctor.show', ['doctor' => $doctor]);
})->name('guest.doctor.show');

// Rotta per la dashboard, protetta dall'autenticazione e verifica email
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rotta per visualizzare tutti i dottori
Route::get('doctors', [DoctorController::class, 'index'])->name('doctors.index');

// Gruppo di rotte protette da autenticazione (richiedono login)
Route::middleware('auth')->group(function () {

    // Rotte per la gestione dei dottori
    Route::resource('doctors', DoctorController::class)->except(['show']);
    
    // Rotta specifica per visualizzare un dottore tramite lo slug
    Route::get('doctors/{doctor:slug}', [DoctorController::class, 'show'])->name('doctors.show');

    // Rotte per le recensioni dei dottori
    Route::resource('reviews', ReviewController::class);
    
    // Rotte per le sponsorizzazioni
    Route::resource('sponsorships', SponsorshipController::class);
    
    // Rotte per le specializzazioni
    Route::resource('specializations', SpecializationController::class);
    
    // Rotte per i messaggi
    Route::resource('messages', MessageController::class);

    // Rotta per visualizzare tutte le recensioni di un dottore specifico
    Route::get('doctors/{doctor}/reviews', [DoctorController::class, 'showReviews'])->name('doctors.reviews');
    
    // Rotta per visualizzare tutti i messaggi di un dottore specifico
    Route::get('doctors/{doctor}/messages', [DoctorController::class, 'showMessages'])->name('doctors.messages');

    // Rotte per la gestione del pagamento tramite Braintree
    Route::get('payment', [BraintreeController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('payment', [BraintreeController::class, 'handlePayment'])->name('payment.handle');
    Route::get('payment/success', function () {
        return view('payment-success');
    })->name('payment.success');

    // Rotte per la gestione del profilo utente
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Inclusione delle rotte di autenticazione generate da Laravel
require __DIR__ . '/auth.php';
