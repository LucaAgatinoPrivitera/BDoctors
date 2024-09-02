@extends('layouts.app')

@section('title', 'Crea il tuo profilo dottore')

@section('content')
	<h1>Aggiungi il tuo profilo da dottore</h1>
	<form action="{{ route('doctors.store') }}" method="POST">
		@csrf
		<div>
			<label class="my-2 py-1" for="surname">Nome:</label>
			<input type="text" id="surname" name="surname" value="Inserisci il tuo nome">
			@error('surname')
				<div>{{ $message }}</div>
			@enderror
		</div>

		<div>
			<label class="my-2 py-1" for="address">Indirizzo:</label>
			<input type="text" id="address" name="address" value="Inserisci il tuo indirizzo">
			@error('address')
				<div>{{ $message }}</div>
			@enderror
		</div>

		<div>
			<label class="my-2 py-1" for="phone">Numero di telefono:</label>
			<input type="text" id="phone" name="phone" value="Inserisci il numero di telefono">
			@error('phone')
				<div>{{ $message }}</div>
			@enderror
		</div>

		<div>
			<label class="my-2 py-1" for="bio">Descrizione</label>
			<input class="text-danger" type="text" id="bio" name="bio" value="Inserisci una descrizione">
			@error('bio')
				<div>{{ $message }}</div>
			@enderror
		</div>

		<div class="form-group">
			<label for="pic">Immagine</label>
			<input type="file" name="pic" class="form-control">
		</div>

		<!-- Aggiungi qui altri campi del form se necessario -->
		<button class="bg-primary my-2 py-1" type="submit">Aggiungi dottore</button>
	</form>
	<a href="{{ route('doctors.index') }}">Torna alla lista dei tipi</a>
@endsection
