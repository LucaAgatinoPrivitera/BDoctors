@extends('layouts.app')

@section('title', 'Show della recensione')

@section('content')
<div class="container container-show mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1 class="card-title text-center mb-4">Recensione per {{ $review->doctor->user->name }}</h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Stelle:</strong> 
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $i <= $review->stars ? 's' : 'r' }} fa-star text-warning"></i>
                    @endfor
                </li>
                <li class="list-group-item">
                    <strong>Recensione:</strong>
                    <p class="review-text">{{ $review->review_text }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Nome Recensore:</strong> {{ $review->name_reviewer }}
                </li>
                <li class="list-group-item">
                    <strong>Email Recensore:</strong> {{ $review->email_reviewer }}
                </li>
            </ul>
            <div class="text-center mt-4">
                <a href="{{ route('reviews.index') }}" class="btn btn-primary">Torna alla lista</a>
                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning">Modifica</a>
            </div>
        </div>
    </div>
</div>
@endsection

