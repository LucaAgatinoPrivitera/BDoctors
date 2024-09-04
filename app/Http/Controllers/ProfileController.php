<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {
        $doctor = Doctor::with('reviews', 'messages')
                        ->where('user_id', $request->user()->id)
                        ->first();
        
        return view('profile.show', compact('doctor'));
    }

    /**
     * Show the form for creating a new profile.
     */
    public function create(Request $request): View
    {
        $user = $request->user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        $specializations = Specialization::all();

        if ($doctor) {
            return redirect()->route('profile.edit');
        }

        return view('profile.create', [
            'user' => $user,
            'specializations' => $specializations
        ]);
    }

    /**
     * Store a newly created profile in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validazione dei dati
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:6|max:255',
            'phone' => 'required|numeric|min:9',
            'bio' => 'required|string|min:15',
            'specializations' => 'required|array',
            'specializations.*' => 'exists:specializations,id',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();
        
        // Creazione del profilo dottore
        $doctor = new Doctor();
        $doctor->user_id = $user->id;
        $doctor->surname = $validatedData['surname'];
        $doctor->address = $validatedData['address'];
        $doctor->phone = $validatedData['phone'];
        $doctor->bio = $validatedData['bio'];
        

        // Gestione del file immagine del profilo
        if ($request->hasFile('pic')) {
            $picPath = $request->file('pic')->store('pics', 'public');
            $doctor->pic = $picPath;
        }

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $doctor->cv = $cvPath;
        } else {
            // Imposta un valore di default per 'cv' se non è stato caricato un file
            $doctor->cv = 'path/to/placeholder.pdf'; // Modifica secondo le tue esigenze
        }

        $doctor->save();

        // Attach specializations
        if (isset($validatedData['specializations'])) {
            $doctor->specializations()->sync($validatedData['specializations']);
        }

        return redirect()->route('profile.show')->with('status', 'profile-created');
    }

    /**
     * Display the form to edit the user's profile.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        $specializations = Specialization::all();

        return view('profile.edit', [
            'user' => $user,
            'doctor' => $doctor,
            'specializations' => $specializations
        ]);
    }

    /**
     * Update the user's profile in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validazione dei dati
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:6|max:255',
            'phone' => 'required|numeric|min:9',
            'bio' => 'required|string|min:15',
            'specializations' => 'required|array',
            'specializations.*' => 'exists:specializations,id',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = $request->user();
        $user->fill($request->only(['name', 'surname', 'email']));
        
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        
        $user->save();

        $doctor = Doctor::where('user_id', $user->id)->first();
        if ($doctor) {
            $doctor->address = $validatedData['address'];
            $doctor->surname = $validatedData['surname'];
            $doctor->phone = $validatedData['phone'];
            $doctor->bio = $validatedData['bio'];
            

            // Gestione del file immagine del profilo
            if ($request->hasFile('pic')) {
                $picPath = $request->file('pic')->store('pics', 'public');
                $doctor->pic = $picPath;
            }

            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('cvs', 'public');
                $doctor->cv = $cvPath;
            } else {
                // Imposta un valore di default per 'cv' se non è stato caricato un file
                $doctor->cv = 'path/to/placeholder.pdf'; // Modifica secondo le tue esigenze
            }

            $doctor->save();
            
            // Sync specializations
            if (isset($validatedData['specializations'])) {
                $doctor->specializations()->sync($validatedData['specializations']);
            }
        } else {
            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            $doctor->address = $validatedData['address'];
            $doctor->phone = $validatedData['phone'];
            $doctor->bio = $validatedData['bio'];

            if ($request->hasFile('pic')) {
                $picPath = $request->file('pic')->store('pics', 'public');
                $doctor->pic = $picPath;
            }

            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('cvs', 'public');
                $doctor->cv = $cvPath;
            }

            $doctor->save();

            if (isset($validatedData['specializations'])) {
                $doctor->specializations()->sync($validatedData['specializations']);
            }
        }

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
