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
    </div>
@endsection
