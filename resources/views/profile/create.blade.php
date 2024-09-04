@extends('layouts.app')

@section('title', 'Crea il tuo profilo dottore')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <h2 class="card-title">
                @if(isset($create) && $create)
                    Crea il tuo Profilo
                @else
                    Modifica Profilo
                @endif
            </h2>

            <!-- Form di creazione del profilo -->
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Nome dell'utente -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $doctor->user->name ?? '') }}" required>
                </div>

                <!-- Cognome dell'utente -->
                <div class="mb-3">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" id="surname" name="surname" class="form-control" value="{{ old('surname', $doctor->surname ?? '') }}" required>
                </div>

                <!-- Indirizzo del dottore -->
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $doctor->address ?? '') }}" required>
                </div>

                <!-- Telefono del dottore -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $doctor->phone ?? '') }}" required>
                </div>

                <!-- Biografia del dottore -->
                <div class="mb-3">
                    <label for="bio" class="form-label">Biografia</label>
                    <textarea id="bio" name="bio" class="form-control" rows="3">{{ old('bio', $doctor->bio ?? '') }}</textarea>
                </div>

                {{-- <!-- Specializzazioni del dottore -->
                <div class="mb-3">
                    <label for="specializations" class="form-label">Specializzazioni</label>
                    <input type="text" id="specializations" name="specializations" class="form-control" value="{{ old('specializations', $doctor->specializations ?? '') }}">
                    <small class="form-text text-muted">Inserisci le specializzazioni separate da virgola.</small>
                </div> --}}
                <!-- Specializzazioni del dottore -->
<div class="mb-3">
    <label class="form-label">Specializzazioni</label>
    <div class="form-check">
        @foreach($specializations as $specialization)
            <input type="checkbox" id="specialization_{{ $specialization->id }}" name="specializations[]" 
                value="{{ $specialization->id }}" 
                class="form-check-input"
                @if(isset($doctor) && $doctor->specializations->contains($specialization->id)) checked @endif
            >
            <label class="form-check-label" for="specialization_{{ $specialization->id }}">
                {{ $specialization->name }}
            </label>
            <br>
        @endforeach
    </div>
    <small class="form-text text-muted">Seleziona le specializzazioni pertinenti.</small>
</div>

                <!-- CV del dottore -->
                <div class="mb-3">
                    <label for="cv" class="form-label">Curriculum Vitae</label>
                    <input type="file" id="cv" name="cv" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    @if(isset($create) && $create)
                        Crea Profilo
                    @else
                        Salva Modifiche
                    @endif
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

