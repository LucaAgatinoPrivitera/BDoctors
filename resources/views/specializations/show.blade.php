@extends('layouts.app')

@section('content')
    <h1>Specializzazione: {{ $specialization->name }}</h1>
    <p>Nome: {{ $specialization->name }}</p>
    <a href="{{ route('specializations.index') }}" class="btn btn-secondary">Torna indietro</a>
@endsection
