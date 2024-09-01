@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Recensione per {{ $review->doctor->user->name }}</h1>
    <ul>
        <li>Stelle: {{ $review->stars }}</li>
        <li>Recensione: {{ $review->review_text }}</li>
        <li>Nome Recensore: {{ $review->name_reviewer }}</li>
        <li>Email Recensore: {{ $review->email_reviewer }}</li>
    </ul>
    <a href="{{ route('reviews.index') }}" class="btn btn-primary">Torna alla lista</a>
</div>
@endsection
