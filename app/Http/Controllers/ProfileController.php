<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log; // Aggiunto l'import di Log
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
            return view('profile.create');
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
        // Validazione dei dati con regole aggiornate
        $validatedData = $request->validate([
            /* 'name' => 'required|string|min:3|max:255', */
            'surname' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:6|max:255',
            'phone' => 'required|numeric|digits_between:9,15', // Controlla se il numero ha un range di cifre corretto
            'bio' => 'required|string|min:15',
            /*  'specializations' => 'required|array',
            'specializations.*' => 'exists:specializations,id', */
            'pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Reso opzionale
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Reso opzionale
        ]);

        $user = Auth::user();

        try {
            // Creazione del profilo dottore
            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            /*$doctor->name = $validatedData['name']; */
            $doctor->surname = $validatedData['surname'];
            $doctor->address = $validatedData['address'];
            $doctor->phone = $validatedData['phone'];
            $doctor->bio = $validatedData['bio'];

            // Gestione del file immagine del profilo
            if ($request->hasFile('pic')) {
                $picPath = $request->file('pic')->store('pics', 'public');
                $doctor->pic = $picPath;
            }

            // Gestione del file CV
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('cvs', 'public');
                $doctor->cv = $cvPath;
            } else {
                // Se il CV non è stato caricato, non impostare alcun valore di default
                $doctor->cv = null;
            }

            // Salva il profilo del dottore nel database
            $doctor->save();

            // Collega le specializzazioni selezionate al dottore
            if (isset($validatedData['specializations'])) {
                $doctor->specializations()->sync($validatedData['specializations']);
            }

            // Reindirizza con un messaggio di successo
            return redirect()->route('profile.show')->with('success', 'Profilo creato con successo!');
        } catch (\Exception $e) {
            // Gestione delle eccezioni con log dell'errore per il debug
            Log::error('Errore durante la creazione del profilo: ' . $e->getMessage()); // Log dettagliato dell'errore

            // Reindirizza con un messaggio di errore dettagliato
            return redirect()->route('profile.create')->with('error', 'Si è verificato un errore durante la creazione del profilo. ' . $e->getMessage());
        }
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
            'phone' => 'required|numeric|digits_between:9,15',
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
            // Aggiorna i dati del dottore
            $doctor->address = $validatedData['address'];
            $doctor->surname = $validatedData['surname'];
            $doctor->phone = $validatedData['phone'];
            $doctor->bio = $validatedData['bio'];

            // Gestione del file immagine del profilo
            if ($request->hasFile('pic')) {
                // Elimina l'immagine precedente se esiste
                if ($doctor->pic && Storage::disk('public')->exists($doctor->pic)) {
                    Storage::disk('public')->delete($doctor->pic);
                }

                $file = $request->file('pic');
                $filename = $file->store('pics', 'public');
                $doctor->pic = basename($filename); // Salva solo il nome del file
            }

            // Gestione del file CV
            if ($request->hasFile('cv')) {
                // Elimina il CV precedente se esiste
                if ($doctor->cv && Storage::disk('public')->exists($doctor->cv)) {
                    Storage::disk('public')->delete($doctor->cv);
                }

                $file = $request->file('cv');
                $filename = $file->store('cvs', 'public');
                $doctor->cv = basename($filename); // Salva solo il nome del file
            } else {
                // Imposta un valore di default per 'cv' se non è stato caricato un file
                $doctor->cv = $doctor->cv ?: 'path/to/placeholder.pdf'; // Modifica secondo le tue esigenze
            }

            $doctor->save();

            // Sync specializations
            if (isset($validatedData['specializations'])) {
                $doctor->specializations()->sync($validatedData['specializations']);
            }
        } else {
            // Crea un nuovo profilo dottore se non esiste
            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            $doctor->address = $validatedData['address'];
            $doctor->phone = $validatedData['phone'];
            $doctor->bio = $validatedData['bio'];

            if ($request->hasFile('pic')) {
                $file = $request->file('pic');
                $filename = $file->store('pics', 'public');
                $doctor->pic = basename($filename); // Salva solo il nome del file
            }

            if ($request->hasFile('cv')) {
                $file = $request->file('cv');
                $filename = $file->store('cvs', 'public');
                $doctor->cv = basename($filename); // Salva solo il nome del file
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

        // Cancella l'utente e termina la sessione
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Aggiungi un return per reindirizzare l'utente, ad esempio alla homepage
        return Redirect::to('/'); // Modifica l'URL di destinazione se necessario
    }
}
