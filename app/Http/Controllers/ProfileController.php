<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{

    public function show(Request $request)
    {
    // $doctor = Doctor::where('user_id', $request->user()->id)->first();
    $doctor = Doctor::with('reviews','messages')->where('user_id', $request->user()->id)->first();
    return view('profile.show', compact('doctor'));
    }

    public function create(Request $request): View
{
    $user = $request->user();
    
    // Controlla se il profilo del dottore esiste
    $doctor = Doctor::where('user_id', $user->id)->first();
    
    
    if ($doctor) {
        return redirect()->route('profile.edit');
    }
    
    
    return view('profile.create', [
        'user' => $user
    ]);
}
    
public function store(Request $request): RedirectResponse
{
    // Validazione dei dati
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'bio' => 'nullable|string',
        'specializations' => 'nullable|string',
        'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $user = Auth::user();
    
    // Creazione del profilo dottore
    $doctor = new Doctor();
    $doctor->user_id = $user->id;
    $doctor->address = $validatedData['address'];
    $doctor->phone = $validatedData['phone'];
    $doctor->bio = $validatedData['bio'];
    $doctor->specializations = $validatedData['specializations'];

    // Gestione del file CV
    if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->store('cvs', 'public');
        $doctor->cv = $cvPath;
    }

    $doctor->save();

    return redirect()->route('profile.show')->with('status', 'profile-created');
}




    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
    $user = $request->user();
    $doctor = Doctor::where('user_id', $user->id)->first();
    
    return view('profile.edit', [
        'user' => $user,
        'doctor' => $doctor
    ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
{
    // Validazione dei dati
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'bio' => 'nullable|string',
        'specializations' => 'nullable|string',
        'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Assicurati che la validazione per il file sia corretta
    ]);

    // Aggiorna le informazioni dell'utente
    $user = $request->user();
    $user->fill($request->only(['name', 'surname', 'email']));
    
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }
    
    $user->save();

    // Aggiorna le informazioni del dottore
    $doctor = Doctor::where('user_id', $user->id)->first();
    if ($doctor) {
        $doctor->fill($request->only(['name','surname','address', 'phone', 'bio', 'specializations','cv']));
        
        // Gestione del file CV
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $doctor->cv = $cvPath;
        }

        $doctor->save();
    } else {
        $doctor = new Doctor($request->only(['address', 'phone', 'bio', 'specializations']));
        $doctor->user_id = $user->id;

        // Gestione del file CV
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $doctor->cv = $cvPath;
        }

        $doctor->save();
    }

    // Reindirizza alla vista di dettaglio del profilo
    return Redirect::route('profile.show')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
