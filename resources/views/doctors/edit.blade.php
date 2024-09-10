@extends('layouts.app')

@section('title', 'Modifica il tuo profilo')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('doctors.update', $doctor) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $doctor->user->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="surname">Cognome</label>
                        <input type="text" class="form-control" id="surname" name="surname" required value="{{ old('surname', $doctor->surname) }}">
                        @error('surname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address">Descrizione</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $doctor->address) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Telefono</label>
                        <textarea class="form-control" id="phone" name="phone" rows="1" required>{{ old('phone', $doctor->phone) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="bio">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4" required>{{ old('bio', $doctor->bio) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="specializations">Specializzazioni</label>
                        <select class="form-select" id="specializations" name="specializations[]" multiple>
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->id }}"
                                    {{ in_array($specialization->id, old('specializations', $doctor->specializations->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $specialization->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('specializations')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="pic">Immagine</label>
                        @if ($doctor->pic)
                            <div class="mb-2">
                                <img src="{{ Storage::url($doctor->pic) }}" alt="Immagine del medico" class="img-thumbnail" style="max-width: 150px;">
                                <p class="mt-2">Immagine attuale</p>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="pic" name="pic">
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="cv">CV</label>
                        @if ($doctor->cv)
                            <div class="mb-2">
                                <a href="{{ Storage::url($doctor->cv) }}" target="_blank" class="btn btn-link">Visualizza il CV attuale</a>
                                <p class="mt-2">CV attuale</p>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="cv" name="cv">
                        @error('cv')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                </form>
            </div>
        </div>
    </div>
@endsection

