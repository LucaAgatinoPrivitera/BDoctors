{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form',['user' => $user])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.app')

@section('title', 'Modifica profilo dottore')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <h2 class="card-title">Modifica Profilo</h2>

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
        </div>
    </div>
</div>
@endsection
