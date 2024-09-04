<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = Specialization::all();
        return view('specializations.index', compact('specializations'));
    }

    public function create()
{
    $doctors = Doctor::all();
    return view('specializations.create', compact('doctors'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'doctors' => 'array'  // Aggiungi validazione per i dottori
        ]);
    
        $specialization = Specialization::create($request->only('name'));
    
        // Associa i dottori alla specializzazione
        if ($request->has('doctors')) {
            $specialization->doctors()->attach($request->doctors);
        }
    
        return redirect()->route('specializations.index')->with('success', 'Specializzazione creata con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialization $specialization)
    {
        return view('specializations.show', compact('specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialization $specialization)
    {
        $doctors = Doctor::all();
    return view('specializations.edit', compact('specialization', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialization $specialization)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'doctors' => 'array'  // Aggiungi validazione per i dottori
        ]);
    
        $specialization->update($request->only('name'));
    
        // Sincronizza i dottori associati
        if ($request->has('doctors')) {
            $specialization->doctors()->sync($request->doctors);
        }
    
        return redirect()->route('specializations.index')->with('success', 'Specializzazione aggiornata con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialization $specialization)
    {
        //
    }

    
}
