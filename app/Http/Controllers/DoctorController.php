<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $specializations = Specialization::all(); // Recupera tutte le specializzazioni dal database
        return view('doctors.create', compact('specializations')); // Passa le specializzazioni alla vista
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
        $data = $request->validate([
            "surname" => "required|min:1|max:255",
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|min:10|max:100',
            'phone' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'bio' => 'nullable|string|max:500',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|file',
            'specializations' => 'required|array|min:1',
        ]);

        // Ottieni l'ID dell'utente autenticato
        $userId = Auth::id();

        // Aggiungi l'ID dell'utente all'array dei dati
        $data['user_id'] = $userId;

        // Gestisci l'upload dell'immagine
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $filename = $file->store('public/images'); // Salva il file nella cartella public/images
            $data['pic'] = basename($filename); // Salva solo il nome del file
        }

        // Crea il nuovo record Doctor
        Doctor::create($data);

        // Reindirizza alla pagina di dettaglio del dottore
        return redirect()->route('doctors.show', ['doctor' => $data['user_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        // Carica la relazione user con il medico
        $doctor = Doctor::with(['user', 'specializations'])->findOrFail($doctor->id);

        $data = [
            "doctor" => $doctor
        ];


        return view("doctors.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $doctor = Doctor::with(['user', 'specializations'])->findOrFail($doctor->id);

        $data = [
            "doctor" => $doctor
        ];

        return view("doctors.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->all();

        // $project->name_project = $data["name_project"];
        // $project->description = $data["description"];
        // $project->date = $data["date"];
        // $project->group = $data["group"];
        // $project->save();

        // $project->fill($data);
        // $project->save();

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

        // Aggiorna il dottore con i dati validati
        $doctor->update($data);

        return redirect()->route('doctors.show', $doctor->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
