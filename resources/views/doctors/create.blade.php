@extends('layouts.app')

@section('title', 'Benvenuto Dottore')

@section('content')
    <!-- Sezione di Benvenuto -->
    <div class="bg-blue-50 p-8 rounded-lg shadow-lg mb-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-800">{{ __('Benvenuto, Dottore!') }}</h1>
            <p class="text-lg text-gray-700 mt-2">{{ __('Siamo lieti di averti con noi. In questa area puoi gestire il tuo profilo, controllare le tue attività e aggiornare le tue informazioni personali.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Cosa Puoi Fare Qui') }}</h2>
            <ul class="list-disc list-inside text-gray-600">
                <li>Gestire il tuo profilo e le tue informazioni personali</li>
                <li>Visualizzare e aggiornare le tue attività recenti</li>
                <li>Controllare le tue notifiche e i tuoi messaggi</li>
                <li>Accedere alle risorse e agli strumenti disponibili per i dottori</li>
            </ul>
        </div>
    </div>

    <!-- Altri contenuti specifici per i dottori -->
    <div class="container mx-auto p-6">
        <!-- Contenuti specifici per i dottori -->
        <div class="container mt-5">
            <h1 class="mb-4 text-primary">Aggiungi il tuo profilo da dottore</h1>
            <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data" class="shadow-lg p-4 bg-white rounded">
                @csrf
    
                <!-- Cognome -->
                <div class="form-group mb-3">
                    <label for="surname" class="form-label">Cognome:</label>
                    <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" placeholder="Inserisci il tuo cognome" required>
                    @error('surname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <!-- Indirizzo -->
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Indirizzo:</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Inserisci il tuo indirizzo" required>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <!-- Numero di Telefono -->
                <div class="form-group mb-3">
                   <label for="phone" class="form-label">Numero di Telefono:</label>
                   <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Inserisci il tuo numero di telefono" required>
                   <div id="phone-warning" class="text-danger" style="display: none;">Il numero di telefono deve contenere solo numeri e avere una lunghezza compresa tra 10 e 15 caratteri.</div>
                   @error('phone')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                   @enderror
                </div>
    
                <script>
                 document.getElementById('phone').addEventListener('input', function () {
                   const phoneInput = this.value;
                   const phoneWarning = document.getElementById('phone-warning');
                   const phonePattern = /^[0-9]{10,15}$/; // Modifica il pattern se necessario
                    if (!phonePattern.test(phoneInput)) {
                      phoneWarning.style.display = 'block';
                    } else {
                      phoneWarning.style.display = 'none';
                    }
                 });
                </script>
    
    
                <!-- Specializzazioni -->
                <div class="form-group mb-3">
                    <label for="specializations" class="form-label">Specializzazioni:</label>
                    <div class="row">
                        @foreach($specializations as $specialization)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="specializations[]" value="{{ $specialization->id }}" 
                                        {{ (old('specializations') && in_array($specialization->id, old('specializations'))) || $selectedSpecialization == $specialization->id ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $specialization->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('specializations')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <!-- Immagine -->
                <div class="form-group mb-3">
                    <label for="pic" class="form-label">Immagine:</label>
                    <input type="file" name="pic" class="form-control-file">
                </div>
    
                <!-- CV -->
                <div class="form-group mb-3">
                    <label for="cv" class="form-label">Curriculum Vitae:</label>
                    <input type="file" name="cv" class="form-control-file">
                </div>
    
                <!-- Descrizione -->
                <div class="form-group mb-4">
                    <label for="bio" class="form-label">Descrizione:</label>
                    <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4" placeholder="Inserisci una breve descrizione" required>{{ old('bio') }}</textarea>
                    @error('bio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                         <!-- Pulsante di invio -->
            <button type="submit" class="btn btn-primary w-100">Salva</button>
        </form>
    </div>
@endsection
