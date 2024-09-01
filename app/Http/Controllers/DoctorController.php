<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
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
        // Recupera tutti i medici dal database
        $doctors = Doctor::with('user')->get();

        // Passa i dati alla vista
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "surname" => "required|min:1|max:255",
            "address" => "required|min:1|max:255",
            "phone" => "required|min:1|max:20",
            'bio' => 'nullable|string|max:500',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ottieni l'ID dell'utente autenticato
        $userId = Auth::id();
        // Ottieni l'utente autenticato
        $user = User::find($userId);

        // Aggiungi i dati all'array, incluso il nome dell'utente
        $data['users_id'] = $userId;
        // $data['user_name'] = $user->name;

        // Gestisci l'upload dell'immagine
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $filename = $file->store('public/images'); // Salva il file nella cartella public/images
            $data['pic'] = basename($filename); // Salva solo il nome del file
        }

        $newDoctor = new Doctor();
        $newDoctor->fill($data);
        $newDoctor->save();

        // Debug per verificare se user_id è stato impostato
        // dd($newDoctor, $user);

        return redirect()->route('doctors.show', $newDoctor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        // Carica la relazione user con il medico
        $doctor = Doctor::with('user')->findOrFail($doctor->id);

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
