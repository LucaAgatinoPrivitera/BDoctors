@extends('layouts.app')

@section('content')
	<div>
		<h1>Cognome: {{ $doctor['surname'] }}</h1>
        {{-- H4 test perché sul sito non cambia tra h1 e h4, da inspector ho visto che va tolto l'inherit, poi ce ne occupiamo alla fine --}}
		<h4>Indirizzo: {{ $doctor['address'] }}</h4>
        <h2>Telefono: {{ $doctor['phone'] }}</h2>
        <h2>Bio: {{ $doctor['bio'] }}</h2>

		</div>
		<a href="{{ route('doctors.index') }}">Torna alla lista dei dottori</a>
	@endsection
