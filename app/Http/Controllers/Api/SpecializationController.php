<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialization; // Assumi che tu abbia un modello per Specialization
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the specializations.
     */
    public function index()
    {
        // Recupera tutte le specializzazioni dal database
        $specializations = Specialization::all();

        // Restituisci i dati in formato JSON
        return response()->json($specializations);
    }
}
