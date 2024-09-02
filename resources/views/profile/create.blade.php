@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <h2 class="card-title">Crea Profilo</h2>

            <!-- Form di creazione del profilo -->
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Nome dell'utente -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <!-- Cognome dell'utente -->
                <div class="mb-3">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" id="surname" name="surname" class="form-control" required>
                </div>

                <!-- Indirizzo del dottore -->
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>

                <!-- Telefono del dottore -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>

                <!-- Biografia del dottore -->
                <div class="mb-3">
                    <label for="bio" class="form-label">Biografia</label>
                    <textarea id="bio" name="bio" class="form-control" rows="3"></textarea>
                </div>

                <!-- Specializzazioni del dottore -->
                <div class="mb-3">
                    <label for="specializations" class="form-label">Specializzazioni</label>
                    <input type="text" id="specializations" name="specializations" class="form-control">
                    <small class="form-text text-muted">Inserisci le specializzazioni separate da virgola.</small>
                </div>

                <!-- CV del dottore -->
                <div class="mb-3">
                    <label for="cv" class="form-label">Curriculum Vitae</label>
                    <input type="file" id="cv" name="cv" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Crea Profilo</button>
            </form>
        </div>
    </div>
</div>
@endsection
