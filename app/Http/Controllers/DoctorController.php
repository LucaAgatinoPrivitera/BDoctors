<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $doctors = Doctor::with('user', 'specializations')->get();
        // Passa i dati alla vista
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Nel tuo DoctorController
    public function create()
    {
        $specializations = specialization::all(); // Recupera tutte le specializzazioni dal database

        $selectedSpecialization = session('specialization');
        

        return view('doctors.create', compact('specializations','selectedSpecialization')); // Passa le specializzazioni alla vista
        $doctor->specializations = $doctor->specializations ?: collect();
    }

    public function getSpecializationsAttribute($value)
    {
        return $value ? collect($value) : collect();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validazione dei dati
    $data = $request->validate([
        'surname' => 'required|string|min:2|max:255',
        'address' => 'required|string|min:5|max:100',
        'phone' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
        'bio' => 'required|string|max:500',
        'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'cv' => 'nullable|file',
        'specializations' => 'required|array|min:1',
        'specializations.*' => 'integer|exists:specializations,id'
    ]);

    // Ottieni l'ID dell'utente autenticato
    $userId = Auth::id();
    $data['user_id'] = $userId; // Associa l'utente al dottore

    // Genera lo slug dal cognome del dottore
    $data['slug'] = Str::slug($data['surname'], '-');

    // Gestisci l'upload dell'immagine
    if ($request->hasFile('pic')) {
        $file = $request->file('pic');
        $filename = $file->store('images', 'public'); // Usa 'images' invece di 'public/images'
        $data['pic'] = basename($filename); // Salva solo il nome del file
    }

    // Crea il dottore e salva le specializzazioni
    $doctor = Doctor::create($data);

    // Associa le specializzazioni
    $doctor->specializations()->sync($data['specializations']);

    // Rimuovi la specializzazione dalla sessione
    $request->session()->forget('specialization');

    // Reindirizza alla pagina del profilo dottore usando lo slug
    return redirect()->route('profile.show');
    }


    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        // Carica le relazioni user e specializations
        $doctor->load(['user', 'specializations']);

        return view('doctors.show', ['doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
{
    // Ottieni tutte le specializzazioni
    $specializations = Specialization::all();

    // Trova il dottore con le specializzazioni
    $doctor = Doctor::with('specializations')->findOrFail($doctor->id);

    // Passa i dati alla vista
    return view('doctors.edit', [
        'doctor' => $doctor,
        'specializations' => $specializations,
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
{
    // Validazione dei dati
    $data = $request->validate([
        'name' => 'required|string|min:3|max:255',
        'surname' => 'required|string|min:3|max:255',
        'address' => 'required|string|min:6|max:255',
        'phone' => 'required|numeric|min:9',
        'bio' => 'required|string|min:15',
        'pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'specializations' => 'required|array',
        'specializations.*' => 'exists:specializations,id',
    ]);
    
    // Genera lo slug dal cognome del dottore
    $data['slug'] = Str::slug($request->input('surname'), '-');

    // Aggiorna i dati dell'utente
    $user = $doctor->user; // Assumendo che il modello Doctor ha una relazione "user"
    $user->name = $request->input('name');
    $user->save();

    // Gestisci l'upload dell'immagine
    if ($request->hasFile('pic')) {
        // Elimina l'immagine precedente se esiste
        if ($doctor->pic && Storage::disk('public')->exists('images/' . $doctor->pic)) {
            Storage::disk('public')->delete('images/' . $doctor->pic);
        }

        $file = $request->file('pic');
        $filename = $file->store('images', 'public');
        $data['pic'] = basename($filename); // Salva solo il nome del file
    } else {
        // Mantieni il nome del file esistente se nessuna nuova immagine è stata fornita
        $data['pic'] = $doctor->pic;
    }

    // Rimuovi `user_id` dai dati di aggiornamento, se non è necessario modificarlo
    unset($data['user_id']);

    // Aggiorna i dati del medico
    $doctor->update($data);

     // Aggiorna le specializzazioni
     $doctor->specializations()->sync($request->input('specializations'));

    return redirect()->route('profile.show');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }

    
}
