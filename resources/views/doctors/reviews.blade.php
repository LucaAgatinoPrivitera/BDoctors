@extends('layouts.app')

@section('title', 'Recensioni di ' . $doctor->user->name . ' ' . $doctor->surname)

@section('content')
    <div class="container mt-5">
        <h2 class="section-title">Tutte le Recensioni</h2>
        @if($doctor->reviews->isNotEmpty())
            <ul class="list-group review-list">
                @foreach($doctor->reviews as $review)
                    <li class="list-group-item review-item">
                        <strong>{{ $review->name_reviewer ?: 'Utente sconosciuto' }} ({{ $review->email_reviewer }}):</strong>
                        <p class="mb-0">{{ $review->review_text }}</p>
                        <p class="text-muted mb-0">{{ $review->created_at->format('d/m/Y H:i') }}</p>
                        <span class="badge bg-primary float-end">{{ $review->stars }} ★</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Nessuna recensione ancora.</p>
        @endif
    </div>
@endsection
