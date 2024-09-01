@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Recensione per {{ $review->doctor->user->name }}</h1>
    <ul>
        <li>Stelle: @for ($i = 1; $i <= 5; $i++)
            <i class="fa{{ $i <= $review->stars ? 's' : 'r' }} fa-star text-warning"></i>
        @endfor</li>
        <li>Recensione: {{ $review->review_text }}</li>
        <li>Nome Recensore: {{ $review->name_reviewer }}</li>
        <li>Email Recensore: {{ $review->email_reviewer }}</li>
    </ul>
    <a href="{{ route('reviews.index') }}" class="btn btn-primary">Torna alla lista</a>
</div>
@endsection
