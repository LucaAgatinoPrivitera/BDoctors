<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Recupera tutti i medici con le loro specializzazioni e paginazione
        $doctors = Doctor::with('specializations')->paginate($request->input('perPage', 30));

        return response()->json($doctors);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        // Carica la relazione specializations con il medico
        $doctor = Doctor::with('specializations')->findOrFail($doctor->id);

        return response()->json($doctor);
    }

    // Aggiungi metodi per store(), update(), destroy() se necessario
}
