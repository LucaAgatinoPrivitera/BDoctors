@extends('layouts.app')

@section('content')
    <h1>Modifica Specializzazione</h1>

    <form action="{{ route('specializations.update', $specialization->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $specialization->name }}" required>
        </div>

        <div class="form-group">
            <label for="doctors">Seleziona Dottori</label>
            <select class="form-control" id="doctors" name="doctors[]" multiple>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}"
                        @if(in_array($doctor->id, $specialization->doctors->pluck('id')->toArray())) selected @endif>
                        {{ $doctor->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna</button>
    </form>
@endsection
