@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crea una nuova Recensione</h1>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="doctor_id" class="form-label">Medico</label>
            <select name="doctor_id" id="doctor_id" class="form-select" required>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="stars" class="form-label">Stelle</label>
            <input type="number" name="stars" id="stars" class="form-control" min="1" max="5" required>
        </div>
        <div class="mb-3">
            <label for="review_text" class="form-label">Recensione</label>
            <textarea name="review_text" id="review_text" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="name_reviewer" class="form-label">Nome Recensore</label>
            <input type="text" name="name_reviewer" id="name_reviewer" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email_reviewer" class="form-label">Email Recensore</label>
            <input type="email" name="email_reviewer" id="email_reviewer" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Crea Recensione</button>
    </form>
</div>
@endsection
