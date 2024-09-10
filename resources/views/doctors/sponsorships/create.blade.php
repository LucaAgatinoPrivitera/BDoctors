@extends('layouts.app')

@section('title', 'Associa una sponsorizzazione')

@section('content')
<div class="container">
    <h1>Associa una sponsorizzazione</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sponsorships.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="sponsorship">Seleziona una sponsorizzazione:</label>
            <select name="sponsorship_id" class="form-control" required>
                @foreach ($sponsorships as $sponsorship)
                    <option value="{{ $sponsorship->id }}">{{ $sponsorship->name }} ({{ $sponsorship->price }}€, {{ $sponsorship->duration }} giorni)</option>
                @endforeach
            </select>
        </div>

        <!-- Campo nascosto per doctor_id -->
        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

        <button type="submit" class="btn btn-success mt-3">Associa Sponsorizzazione</button>
    </form>
</div>
@endsection


