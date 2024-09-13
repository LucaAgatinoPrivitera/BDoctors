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
        $query = Doctor::with('specializations', 'reviews', 'sponsorships');

        // Aggiungi filtri basati su parametri di ricerca
        if ($request->has('specializations')) {
            $specializations = $request->input('specializations');
            $query->whereHas('specializations', function ($q) use ($specializations) {
                $q->whereIn('name', $specializations);
            });
        }

        // Recupera i medici sponsorizzati con sponsorizzazione attiva
        $sponsoredDoctors = $query->join('doctor_sponsorship', 'doctors.id', '=', 'doctor_sponsorship.doctor_id')
            ->join('sponsorships', 'doctor_sponsorship.sponsorship_id', '=', 'sponsorships.id')
            ->whereDate('doctor_sponsorship.date_end', '>=', now())
            ->select('doctors.*', 'doctor_sponsorship.sponsorship_id')
            ->orderByRaw("FIELD(doctor_sponsorship.sponsorship_id, 4, 3, 2, 1)") // Ordina per ID sponsorizzazione specificato
            ->distinct()
            ->get();

        // Recupera i medici non sponsorizzati (senza sponsorizzazioni attive)
        $unsponsoredDoctors = $query->whereDoesntHave('sponsorships', function ($q) {
            $q->whereDate('date_end', '>=', now());
        })->get();

        // Unisci i medici sponsorizzati e non sponsorizzati
        $doctors = $sponsoredDoctors->merge($unsponsoredDoctors);

        return response()->json($doctors);
    }

    public function getDoctors(Request $request)
    {
        // Recupera i medici sponsorizzati con sponsorizzazione attiva
        $sponsoredDoctors = Doctor::with('specializations', 'reviews', 'sponsorships')
            ->join('doctor_sponsorship', 'doctors.id', '=', 'doctor_sponsorship.doctor_id')
            ->join('sponsorships', 'doctor_sponsorship.sponsorship_id', '=', 'sponsorships.id')
            ->whereDate('doctor_sponsorship.date_end', '>=', now())
            ->select('doctors.*', 'doctor_sponsorship.sponsorship_id')
            ->orderByRaw("FIELD(doctor_sponsorship.sponsorship_id, 4, 3, 2, 1)") // Ordina per ID sponsorizzazione specificato
            ->distinct()
            ->get();

        // Recupera i medici non sponsorizzati (senza sponsorizzazioni attive)
        $unsponsoredDoctors = Doctor::with('specializations', 'reviews')
            ->whereDoesntHave('sponsorships', function ($query) {
                $query->whereDate('date_end', '>=', now());
            })
            ->get();

        // Unisci i medici sponsorizzati e non sponsorizzati
        $doctors = $sponsoredDoctors->merge($unsponsoredDoctors);

        return response()->json($doctors);
    }




    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Recupera un medico specifico dal database con lo slug fornito, includendo le recensioni
        $doctor = Doctor::with(['user', 'specializations', 'reviews'])->where('slug', $slug)->first();

        if ($doctor) {
            return response()->json($doctor);
        } else {
            return response()->json(['error' => 'Dottore non trovato'], 404);
        }
    }


    /*public function getDoctors(Request $request)
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

        $doctors = $query->paginate(15);
        return response()->json($doctors);
    }*/
}
