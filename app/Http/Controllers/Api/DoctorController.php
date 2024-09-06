<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function show($slug)
    {
        // Recupera un medico specifico dal database con lo slug fornito
        $doctor = Doctor::with(['user', 'specializations'])->where('slug', $slug)->first();

        if ($doctor) {
            return response()->json($doctor);
        } else {
            return response()->json(['error' => 'Dottore non trovato'], 404);
        }
    }


    public function getDoctors(Request $request)
    {
        $query = Doctor::query();

        Log::info('Request Parameters:', $request->all());

        if ($request->has('specializations')) {
            $specializations = $request->input('specializations');

            Log::info('Specializations Filter:', $specializations);

            if (is_array($specializations) && !empty($specializations)) {
                $query->whereHas('specializations', function ($q) use ($specializations) {
                    $q->whereIn('name', $specializations);
                });
            }
        }

        $doctors = $query->paginate(10);
        return response()->json($doctors);
    }
}
