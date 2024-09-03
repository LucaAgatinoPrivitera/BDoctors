@extends('layouts.app')

@section('content')
    <h1>Specializzazioni</h1>
    <a href="{{ route('specializations.create') }}" class="btn btn-primary">Crea nuova Specializzazione</a>

    <ul>
        @foreach ($specializations as $specialization)
            <li>
                <a href="{{ route('specializations.show', $specialization->id) }}">{{ $specialization->name }}</a>
                <a href="{{ route('specializations.edit', $specialization->id) }}" class="btn btn-warning">Modifica</a>

                <form action="{{ route('specializations.destroy', $specialization->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
