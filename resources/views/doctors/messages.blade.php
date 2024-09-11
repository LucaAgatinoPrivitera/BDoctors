@extends('layouts.app')

@section('title', 'Messaggi di ' . $doctor->user->name . ' ' . $doctor->surname)

@section('content')
    <div class="container mt-5">
        <h2 class="section-title">Tutti i Messaggi Ricevuti</h2>
        @if($doctor->messages->isNotEmpty())
            <ul class="list-group message-list">
                @foreach($doctor->messages as $message)
                    <li class="list-group-item message-item">
                        <strong>Da: {{ $message->name }} ({{ $message->email }})</strong>
                        <p class="mb-0">{{ $message->message }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Nessun messaggio ricevuto.</p>
        @endif
    </div>
@endsection
