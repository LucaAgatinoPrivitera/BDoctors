<!-- Form di creazione del profilo -->
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

                <!-- Mostra il messaggio di errore -->
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Mostra i messaggi di errore di validazione -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Form di creazione del profilo -->
                <form id="profileForm" method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                    @csrf

                        <!-- Cognome dell'utente -->
                        <div class="col-12 col-md-6 mb-3">
                            <label for="surname" class="form-label">Cognome</label>
                            <input type="text" id="surname" name="surname" class="form-control"
                                value="{{ old('surname') }}" required minlength="3">
                            @error('surname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Indirizzo del dottore -->
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Indirizzo</label>
                            <input type="text" id="address" name="address" class="form-control"
                                value="{{ old('address') }}" required>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telefono del dottore -->
                        <div class="col-12 mb-3">
                            <label for="phone" class="form-label">Telefono</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ old('phone') }}" required pattern="\d{9,}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Biografia del dottore -->
                        <div class="col-12 mb-3">
                            <label for="bio" class="form-label">Biografia</label>
                            <textarea id="bio" name="bio" class="form-control" required>{{ old('bio') }}</textarea>
                            @error('bio')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto del Profilo -->
                        <div class="col-12 col-md-6 mb-2">
                            <label for="pic" class="form-label">Foto del Profilo:</label>
                            <input type="file" id="pic" name="pic" class="form-control"
                                accept=".jpg, .jpeg, .png" required>
                            <small class="form-text text-muted">Carica una foto del profilo (JPG, JPEG,
                                PNG).</small>
                            @error('pic')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Curriculum Vitae -->
                        <div class="col-12 col-md-6 mb-2">
                            <label for="cv" class="form-label">Curriculum Vitae:</label>
                            <input type="file" id="cv" name="cv" class="form-control"
                                accept=".pdf, .doc, .docx" required>
                            <small class="form-text text-muted">Carica il Curriculum Vitae (PDF, DOC,
                                DOCX).</small>
                            @error('cv')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bottone per inviare il modulo -->
                        <div class="d-flex justify-content-start mt-3">
                            <button type="submit" class="btn btn-primary me-2">Crea Profilo</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
