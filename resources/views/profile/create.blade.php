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
                    <form action="{{ route('doctors.store') }}" method="POST">
                        @csrf <!-- Questo è per la sicurezza, necessario nei form Laravel -->
                    
     <!-- create.blade.php -->
<form action="{{ route('doctors.store') }}" method="POST">
    @csrf <!-- Questo token di sicurezza è necessario per i form in Laravel -->

    <!-- Altri campi per il dottore -->
        <!-- Itera su tutte le specializzazioni per creare una checkbox per ciascuna -->
        <h5 class="mt-4">Seleziona le Specializzazioni</h5>
        <div class="form-check">
            <input type="checkbox" name="specializations[]" value="1" id="specialization-1">
            <label for="specialization-1">Cardiologia</label><br>
        </div>
        <div class="form-check">
            <input type="checkbox" name="specializations[]" value="2" id="specialization-2">
            <label for="specialization-2">Neurologia</label><br>
        </div>
           <div class="form-check">
                <input type="checkbox" name="specializations[]" value="5" id="specialization-5">
                <label for="specialization-5">Oncologia</label><br>
            </div>
        <div class="form-check">
            <input type="checkbox" name="specializations[]" value="5" id="specialization-5">
            <label for="specialization-5">Urologia</label><br>
        </div>
        <div class="form-check">
            <input type="checkbox" name="specializations[]" value="5" id="specialization-5">
            <label for="specialization-5">Dermatologia</label><br>
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
