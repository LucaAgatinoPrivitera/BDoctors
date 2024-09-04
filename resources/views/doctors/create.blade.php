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

		  <!-- Address -->
		<div class="form-group">
			<label for="address">Indirizzo</label>
			<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
			@error('address')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		 <!-- Phone -->
		 <div class="form-group">
			<label for="phone">Numero di Telefono</label>
			<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
			@error('phone')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<!-- Specializations -->
		<div class="form-group">
			<label for="specializations">Specializzazioni</label>
			@foreach($specializations as $specialization)
				<div class="form-check">
					<input type="checkbox" class="form-check-input" name="specializations[]" value="{{ $specialization->id }}" {{ in_array($specialization->id, old('specializations', [])) ? 'checked' : '' }}>
					<label class="form-check-label">{{ $specialization->name }}</label>
				</div>
			@endforeach
			@error('specializations')
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>
	
		<button type="submit" class="btn btn-primary">Salva</button>
	</form>


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
