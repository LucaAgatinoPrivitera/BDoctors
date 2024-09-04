@extends('layouts.app')

@section('title', 'Crea il tuo profilo dottore')

@section('content')
<div class="container mt-3">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <h2 class="card-title mb-4">
                Crea Profilo
            </h2>

            <!-- Form di creazione del profilo -->
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <!-- Nome dell'utente -->
                    <div class="col-12 col-md-6 mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $doctor->user->name ?? '') }}" required minlength="3">
                    </div>

                    <!-- Cognome dell'utente -->
                    <div class="col-12 col-md-6 mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" class="form-control" value="{{ old('surname', $doctor->surname ?? '') }}" required minlength="3">
                    </div>

                    <!-- Indirizzo del dottore -->
                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $doctor->address ?? '') }}" required>
                    </div>

                    <!-- Telefono del dottore -->
                    <div class="col-12 mb-3">
                        <label for="phone" class="form-label">Telefono</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $doctor->phone ?? '') }}" required pattern="\d{9,}">
                    </div>

                    <!-- Biografia del dottore -->
                    <div class="col-12 mb-3">
                        <label for="bio" class="form-label">Biografia</label>
                        <textarea id="bio" name="bio" class="form-control" rows="2">{{ old('bio', $doctor->bio ?? '') }}</textarea>
                    </div>

                    <!-- Specializzazioni del dottore -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Specializzazioni</label>
                        <div class="row">
                            @foreach($specializations as $specialization)
                                <div class="col-12 col-md-4 mb-2">
                                    <input type="checkbox" id="specialization_{{ $specialization->id }}" name="specializations[]" 
                                        value="{{ $specialization->id }}" 
                                        class="form-check-input"
                                        @if(isset($doctor) && $doctor->specializations->contains($specialization->id)) checked @endif
                                    >
                                    <label class="form-check-label" for="specialization_{{ $specialization->id }}">
                                        {{ $specialization->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('specializations')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Seleziona almeno una specializzazione.</small>
                    </div>

                    <!-- Foto del Profilo e CV del dottore -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Foto del Profilo e Curriculum Vitae</label>
                        <div class="row">
                            <!-- Immagine del profilo -->
                            <div class="col-12 col-md-6 mb-2">
                                <input type="file" id="pic" name="pic" class="form-control">
                                <small class="form-text text-muted">Carica una foto del profilo.</small>
                            </div>

                            <!-- CV del dottore -->
                            <div class="col-12 col-md-6 mb-2">
                                <input type="file" id="cv" name="cv" class="form-control">
                                <small class="form-text text-muted">Carica il Curriculum Vitae (PDF, DOC, DOCX).</small>
                                
                            </div>
                        </div>
                    </div>
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
