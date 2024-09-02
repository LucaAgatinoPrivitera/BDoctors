<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Doctor;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = Message::with('doctor')->get();

        return view('message.index', compact('message'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
/*        $message = Message::all(); 
 */       $doctors = Doctor::all();


       return view('message.create', compact('doctors'))    ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'name_reviewer' => 'required|string|max:255',
            'email_reviewer' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
    
        // 2. Creazione di un nuovo record nel database
        Message::create([
            'doctor_id' => $request->input('doctor_id'),
            'name_reviewer' => $request->input('name_reviewer'),
            'email_reviewer' => $request->input('email_reviewer'),
            'message' => $request->input('message'),
        ]);
    
        // 3. Redirezione con un messaggio di successo
        return redirect()->route('messages.index')->with('success', 'Messaggio creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        {
            $doctors = Doctor::all(); // Se vuoi permettere il cambio del dottore
            return view('message.edit', compact('message', 'doctors'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        {
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'name_reviewer' => 'required|string|max:255',
                'email_reviewer' => 'required|email|max:255',
                'message' => 'required|string',
            ]);
        
            $message->update($request->all());
        
            return redirect()->route('messages.index')->with('success', 'Messaggio aggiornato con successo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $messages)
    {
        //
    }
}
