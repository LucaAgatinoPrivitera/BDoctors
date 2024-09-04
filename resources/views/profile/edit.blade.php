@extends('layouts.app')

@section('title', 'Modifica profilo dottore')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <h2 class="card-title">Modifica Profilo</h2>

            @if ($doctor)
            <!-- Form di aggiornamento del profilo -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Nome dell'utente -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $doctor->user->name) }}" required>
                </div>

                <!-- Cognome dell'utente -->
                <div class="mb-3">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" id="surname" name="surname" class="form-control" value="{{ old('surname', $doctor->surname) }}" required>
                </div>

                <!-- Indirizzo del dottore -->
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $doctor->address) }}" required>
                </div>

                <!-- Telefono del dottore -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}" required>
                </div>

                <!-- Biografia del dottore -->
                <div class="mb-3">
                    <label for="bio" class="form-label">Biografia</label>
                    <textarea id="bio" name="bio" class="form-control" rows="3">{{ old('bio', $doctor->bio) }}</textarea>
                </div>

                <!-- Specializzazioni del dottore -->
                <div class="mb-3">
                    <label for="specializations" class="form-label">Specializzazioni</label>
                    <input type="text" id="specializations" name="specializations" class="form-control" value="{{ old('specializations', implode(', ', $doctor->specializations->pluck('name')->toArray())) }}">
                    <small class="form-text text-muted">Inserisci le specializzazioni separate da virgola.</small>
                </div>

                <!-- CV del dottore -->
                <div class="mb-3">
                    <label for="cv" class="form-label">Curriculum Vitae</label>
                    <input type="file" id="cv" name="cv" class="form-control">
                    @if($doctor->cv)
                        <a href="{{ asset('storage/' . $doctor->cv) }}" class="btn btn-secondary mt-2">Visualizza CV Attuale</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
            </form>
            @else
                <p>Non è stato trovato alcun profilo da modificare. <a href="{{ route('profile.create') }}">Crea un nuovo profilo.</a></p>
            @endif
        </div>
    </div>
</div>
@endsection

