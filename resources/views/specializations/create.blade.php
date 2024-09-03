@extends('layouts.app')

@section('content')
    <h1>Crea nuova Specializzazione</h1>

    <form action="{{ route('specializations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="doctors">Seleziona Dottori</label>
            <select class="form-control" id="doctors" name="doctors[]" multiple>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->surname }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
@endsection
