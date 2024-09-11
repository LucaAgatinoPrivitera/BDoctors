<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name_reviewer' => 'required|string|max:255',
            'stars' => 'required|integer|between:1,5',
            'email_reviewer' => 'required|string|max:40',
            'review_text' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',  // Mantieni comunque il riferimento al medico se necessario
        ]);

        $review = Review::create([
        'doctor_id' => $request->doctor_id,
        'name_reviewer' => $request->name_reviewer,
        'email_reviewer' => $request->email_reviewer,
        'stars' => $request->stars,
        'review_text' => $request->review_text,
        ]);

        return response()->json(['message' => 'Recensione inviata con successo!', 'data' => $review], 201);
    }
}
