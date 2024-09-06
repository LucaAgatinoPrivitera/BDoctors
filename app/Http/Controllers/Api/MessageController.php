<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',  // Mantieni comunque il riferimento al medico se necessario
        ]);

        $message = Message::create([
            'doctor_id' => $request->doctor_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Messaggio inviato con successo!', 'data' => $message], 201);
    }
}
