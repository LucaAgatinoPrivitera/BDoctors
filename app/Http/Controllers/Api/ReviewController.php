<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $doctorId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string',
        ]);

        $review = Review::create([
            'doctor_id' => $doctorId,
            'name' => $request->name,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json(['message' => 'Recensione inviata con successo!', 'data' => $review], 201);
    }
}
