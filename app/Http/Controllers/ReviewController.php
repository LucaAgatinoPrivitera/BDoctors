<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('doctor')->get();

        return view('reviews.index' , compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Recupera tutti i medici per il dropdown nel form
    $doctors = Doctor::all();

    // Ritorna la vista del form con la lista dei medici
    return view('reviews.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Valida i dati in arrivo
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'stars' => 'required|integer|min:1|max:5',
        'review_text' => 'required|string|max:1000',
        'name_reviewer' => 'required|string|max:255',
        'email_reviewer' => 'required|email|max:255',
    ]);

    // Crea una nuova recensione con i dati validati
    Review::create($request->all());

    // Reindirizza a una pagina a scelta con un messaggio di successo
    return redirect()->route('reviews.index')->with('success', 'Recensione creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('reviews.show' , compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:1000',
            'name_reviewer' => 'required|string|max:255',
            'email_reviewer' => 'required|email|max:255',
        ]);

        $review->update($validated);

        return redirect()->route('reviews.show', $review->id)->with('success', 'Recensione aggiornata con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
