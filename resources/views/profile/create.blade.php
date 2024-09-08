@extends('layouts.app')

@section('title', 'Crea il tuo profilo dottore')

@section('content')
<div class="container mt-3">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <h2 class="card-title mb-4">Crea Profilo</h2>

            <!-- Mostra il messaggio di successo -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form di creazione del profilo -->
            <form id="profileForm" method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <!-- Nome dell'utente -->
                    <div class="col-12 col-md-6 mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required minlength="3">
                    </div>

                    <!-- Cognome dell'utente -->
                    <div class="col-12 col-md-6 mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" id="surname" name="surname" class="form-control" value="{{ old('surname') }}" required minlength="3">
                    </div>

                    <!-- Indirizzo del dottore -->
                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Indirizzo</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
                    </div>

                    <!-- Telefono del dottore -->
                    <div class="col-12 mb-3">
                        <label for="phone" class="form-label">Telefono</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required pattern="\d{9,}">
                    </div>

                    <!-- Biografia del dottore -->
                    <div class="col-12 mb-3">
                        <label for="bio" class="form-label">Biografia</label>
                        <textarea id="bio" name="bio" class="form-control" required>{{ old('bio') }}</textarea>
                    </div>

                    <!-- Foto del Profilo -->
                    <div class="col-12 col-md-6 mb-2">
                        <label for="pic" class="form-label">Foto del Profilo:</label>
                        <input type="file" id="pic" name="pic" class="form-control" accept=".jpg, .jpeg, .png" required>
                        <small class="form-text text-muted">Carica una foto del profilo (JPG, JPEG, PNG).</small>
                        <div id="pic-error-message" class="text-danger" style="display:none;"></div>
                    </div>

                    <!-- Curriculum Vitae -->
                    <div class="col-12 col-md-6 mb-2">
                        <label for="cv" class="form-label">Curriculum Vitae:</label>
                        <input type="file" id="cv" name="cv" class="form-control" accept=".pdf, .doc, .docx" required>
                        <small class="form-text text-muted">Carica il Curriculum Vitae (PDF, DOC, DOCX).</small>
                        <div id="cv-error-message" class="text-danger" style="display:none;"></div>
                    </div>

                    <!-- Bottone per inviare il modulo -->
                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" class="btn btn-primary me-2">Crea Profilo</button>
                    </div>
                </div>
            </form>

               <!-- Mostra il messaggio di successo -->
               @if (session('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{ session('success') }}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
           @endif

           <!-- Form di creazione del profilo -->
           <form id="profileForm" method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
               @csrf
               
               <!-- Il resto del modulo va qui -->

           </form>
        </div>
    </div>
</div>
@endsection

