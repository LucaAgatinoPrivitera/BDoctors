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
    public function index()
    {
        // Recupera tutti i medici dal database
        $doctors = Doctor::with('user')->get();

        // Restituisci i dati in formato JSON
        return response()->json($doctors);
    }
}
