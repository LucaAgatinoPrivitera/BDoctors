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
        $perPage = $request->get('perPage', 10); // Recupera 'perPage' con default a 10
        $page = $request->get('page', 1); // Recupera 'page' con default a 1

        // Recupera i medici con paginazione
        $doctors = Doctor::with('specializations')->paginate($perPage, ['*'], 'page', $page);

        return response()->json($doctors);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Recupera un medico specifico dal database con l'ID fornito
        $doctor = Doctor::with(['user', 'specializations'])->find($id);

        if ($doctor) {
            // Restituisci i dati del medico in formato JSON
            return response()->json($doctor);
        } else {
            // Restituisci un errore 404 se il medico non è trovato
            return response()->json(['error' => 'Dottore non trovato'], 404);
        }
    }
}
