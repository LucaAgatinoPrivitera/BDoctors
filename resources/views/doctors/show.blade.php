@extends('layouts.app')

@section('title', $doctor->user->name)

@section('content')
	<div>
		@if ($doctor->pic)
			<img src="{{ asset('storage/images/' . $doctor->pic) }}" alt="Immagine del medico" style="width: 200px; height: auto;">
		@else
			<p>Immagine non disponibile</p>
		@endif
		<p>URL dell'immagine: {{ Storage::url($doctor->pic) }}</p>
		<h1>Nome: {{ $doctor->user->name }}</h1>
		<h1>Cognome: {{ $doctor['surname'] }}</h1>
		{{-- H4 test perché sul sito non cambia tra h1 e h4, da inspector ho visto che va tolto l'inherit, poi ce ne occupiamo alla fine --}}
		<h4>Indirizzo: {{ $doctor['address'] }}</h4>
		<h2>Telefono: {{ $doctor['phone'] }}</h2>
		<h2>Bio: {{ $doctor['bio'] }}</h2>
		<h3>Specializzazioni</h3>
		<ul>
			@foreach ($doctor->specializations as $specialization)
				<li>{{ $specialization->name }}</li>
			@endforeach
		</ul>

		{{-- @php
			$activeSponsorship = $doctor->activeSponsorship();
			dd($activeSponsorship); // Questo mostrerà il contenuto dell'oggetto sponsorizzazione
		@endphp --}}

		{{-- Nuovo campo per la sponsorizzazione attiva --}}
		<h3>Sponsorizzazione Attuale</h3>
		@php
			$activeSponsorship = $doctor->activeSponsorship();
		@endphp
		@if ($activeSponsorship)
			<p>Nome: {{ $activeSponsorship->pivot->name }}</p>
			<p>Prezzo: {{ $activeSponsorship->pivot->price }}</p>
			{{-- <p>Data Inizio: {{ $activeSponsorship->pivot->date_start->format('d/m/Y') }}</p>
			<p>Data Fine: {{ $activeSponsorship->pivot->date_end->format('d/m/Y') }}</p> --}}
		@else
			<p>Non è attiva alcuna sponsorizzazione.</p>
		@endif

	</div>
	<a class="btn btn-success my-4" href="{{ route('doctors.index') }}">Torna alla lista dei dottori</a>
@endsection
