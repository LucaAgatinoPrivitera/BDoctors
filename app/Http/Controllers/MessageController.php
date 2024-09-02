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
        $message = message::with('doctor')->get();

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
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $messages)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $messages)
    {
        //
    }
}
