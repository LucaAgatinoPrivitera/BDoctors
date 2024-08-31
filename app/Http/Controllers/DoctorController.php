<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

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
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //PRENDO TUTTI I DATI
        // $data = $request->all();

        // Qui abbiamo la validazione
        $data = $request->validate([
            // "id" => "required",
            "surname" => "required|min:1|max:255",
            "address" => "required|min:1|max:255",
            "phone" => "required|min:1|max:20",
            'bio' => 'nullable|string|max:500',
        ]);


        //CREO L'OGGETTO
        $newDoctor = new Doctor();

        //POPOLO L'OGGETTO CREANDO L'ISTANZA
        $newDoctor->fill($data);

        //SALVO SUL DB
        $newDoctor->save();

        //RITORNO LA ROTTA
        // return redirect()->route('project.index');
        return redirect()->route('admin.doctors.show', $newDoctor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $data = [
            "doctor" => $doctor
        ];
    
        return view("admin.doctors.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $data = [
            "doctor" => $doctor
        ];

        return view("admin.doctors.edit", $data);
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


        //Se ricordo bene la parte sopra è la parte allungata, mentre sotto quella abbreviata
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
