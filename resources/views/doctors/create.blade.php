@extends('layouts.app')

@section('title', 'Benvenuto Dottore')

@section('content')
    <div class="container mx-auto p-8 max-w-4xl">
        <!-- Sezione di Benvenuto -->
        <div class="bg-blue-50 p-8 rounded-lg shadow-lg mb-8">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-blue-800">{{ __('Benvenuto, Dottore!') }}</h1>
                <p class="text-lg text-gray-700 mt-2">{{ __('Siamo lieti di averti con noi. Qui puoi gestire il tuo profilo e aggiornare le informazioni.') }}</p>
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

        <!-- Messaggi di Successo ed Errore -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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

        <!-- Form di Creazione del Profilo -->
        <form id="profileForm" method="POST" action="{{ route('doctors.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Cognome dell'utente -->
                <div class="col-span-2">
                    <label for="surname" class="form-label block text-gray-700 font-semibold mb-2">Cognome</label>
                    <input type="text" id="surname" name="surname" class="form-control block w-full px-4 py-2 border rounded-md"
                           value="{{ old('surname') }}" required>
                    @error('surname')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Indirizzo del dottore -->
                <div class="col-span-2">
                    <label for="address" class="form-label block text-gray-700 font-semibold mb-2">Indirizzo</label>
                    <input type="text" id="address" name="address" class="form-control block w-full px-4 py-2 border rounded-md"
                           value="{{ old('address') }}" required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Telefono del dottore -->
                <div class="col-span-2">
                    <label for="phone" class="form-label block text-gray-700 font-semibold mb-2">Telefono</label>
                    <input type="text" id="phone" name="phone" class="form-control block w-full px-4 py-2 border rounded-md"
                           value="{{ old('phone') }}" required pattern="\d{9,}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Biografia del dottore -->
                <div class="col-span-2">
                    <label for="bio" class="form-label block text-gray-700 font-semibold mb-2">Biografia</label>
                    <textarea id="bio" name="bio" class="form-control block w-full px-4 py-2 border rounded-md"
                              required>{{ old('bio') }}</textarea>
                    @error('bio')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto del Profilo -->
                <div>
                    <label for="pic" class="form-label block text-gray-700 font-semibold mb-2">Foto del Profilo:</label>
                    <input type="file" id="pic" name="pic" class="form-control block w-full px-4 py-2 border rounded-md"
                           accept=".jpg, .jpeg, .png" required>
                    <small class="text-gray-600">Carica una foto del profilo (JPG, JPEG, PNG).</small>
                    @error('pic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Curriculum Vitae -->
                <div>
                    <label for="cv" class="form-label block text-gray-700 font-semibold mb-2">Curriculum Vitae:</label>
                    <input type="file" id="cv" name="cv" class="form-control block w-full px-4 py-2 border rounded-md"
                           accept=".pdf, .doc, .docx" required>
                    <small class="text-gray-600">Carica il Curriculum Vitae (PDF, DOC, DOCX).</small>
                    @error('cv')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Bottone per inviare il modulo -->
            <div class="mt-6 text-left">
                <button type="submit" class="btn btn-primary">Crea Profilo</button>
            </div>
        </form>
    </div>
@endsection
